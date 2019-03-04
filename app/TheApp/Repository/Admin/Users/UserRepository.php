<?php
namespace App\TheApp\Repository\Admin\Users;

use App\TheApp\Libraries\ImgRepository;
use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\User;
use Auth;
use DB;

class UserRepository
{
    protected $model;

    function __construct(User $user)
    {
        $this->model = $user;
    }  

    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->model
                            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
                            ->groupBy('date')
                            ->pluck('date');

        $userCounter = $this->model
                        ->select( \DB::raw("count(id) as countDate"))
                        ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                        ->get();

        $data["countDate"] = json_encode(array_pluck($userCounter, 'countDate'));

        return $data;
    }

    public function userActiveStatus()
    {
        $users = $this->model->select("active", \DB::raw("count(id) as count"))
                        ->groupBy('active')
                        ->get();


        foreach ($users as $row) {

            if ($row->active == 0) {
                $row->type = "غير مفعل";
            }elseif ($row->active == 1){
                $row->type ="مفعل";
            }

        }

        $data["usersCount"] = json_encode(array_pluck($users, 'count'));
        $data["usersType"]  = json_encode(array_pluck($users, 'type'));

        return $data;
    }

    public function getAllTokens()
    {
        return $this->model->where('device_id','!=',"")->pluck('device_id')->toArray();
    }

    public function count()
    {
        return $this->model->count();
    }
    
    public function getAll($order = 'id', $sort = 'desc')
    {
        return $this->model->orderBy($order, $sort)->get();
    }
    
    public function notHasAgency()
    {
        return $this->model
                ->whereHas('roles.perms', function($query){
                            $query->where('name','agency_dashboard');
                        })
                ->doesnthave('adminOfAgency')
                ->orderBy('id', 'desc')
                ->get();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create($request)
    {
        DB::beginTransaction();
    
        if ($request->hasFile('image'))
            $image = ImgRepository::uploadImage($request['image']);
        else
            $image  = 'uploads/user.png';

        try {
            
            $user = $this->model->create([
                    'full_name'     => $request['full_name'],
                    'email'         => $request['email'],
                    'active'        => $request['active'],
                    'mobile'        => $request['mobile'],
                    'password'      => bcrypt($request['password']),
                    'image'         => $image,
                    'api_token'     => $this->generateApiKey(),
                ]);

            if($request['roles'] != null)
                $this->saveRoles($user,$request);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function saveRoles($user,$request)
    {
        foreach ($request['roles'] as $key => $value) {
            $user->attachRole($value);
        }

        return true;
    }

    public function update($request , $id)
    {
        DB::beginTransaction();

        $user = $this->findById($id);

        if ($request['password'] == null)
            $password = $user['password'];
        else
            $password  = bcrypt($request['password']);

        if ($request->hasFile('image'))
            $image = ImgRepository::uploadImage($request['image']);
        else
            $image  = $user->image;

        try {
            $user->update([
                'full_name'     => $request['full_name'],
                'email'         => $request['email'],
                'active'        => $request['active'],
                'mobile'        => $request['mobile'],
                'image'         => $image,
                'password'      => $password,
            ]);

            if($request['roles'] != null)
            {
                DB::table('role_user')->where('user_id',$id)->delete();
            
                foreach ($request['roles'] as $key => $value) {
                    $user->attachRole($value);
                }
            }


            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function generateApiKey()
    {
      $key = str_random($length = 32);
      if($this->model->where('api_token' , $key)->count() == 0)
        return $key;

      $this->generateApiKey();
    }

    public function delete($id)
    {
        $user = $this->findById($id);
        return $user->delete();
    }

    public function deleteAll($request)
    {
        return $roles = $this->model->destroy($request['ids']);
    }

    public function dataTable($request)
    {
        $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');    
        $sort['dir'] = $request->input('order.0.dir');
        $search      = $request->input('search.value');

        // Search Query
        $query = $this->filter($request,$search);

        $output['recordsTotal']    = $query->count();
        $output['recordsFiltered'] = $query->count();
        $output['draw']            = intval($request->input('draw'));

        // Get Data
        $users = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($users))
        {
            foreach ($users as $user)
            {
                $id = $user['id'];

                $show   = btn('show'  ,'show_users'  ,url(route('users.show',$id)));
                $edit   = btn('edit'  ,'edit_users'  ,url(route('users.edit',$id)));
                $delete = btn('delete','delete_users',url(route('users.show',$id)));

                $obj['id']          = $id;
                $obj['full_name']   = $user->full_name;
                $obj['mobile']      = $user->mobile;
                $obj['email']       = $user->email;
                $obj['image']       = url($user->image);
                $obj['roles']       = $user->roles;
                $obj['active']      = Status($user->active);
                $obj['created_at']  = date("d-m-Y", strtotime($user->created_at));
                $obj['listBox']     = checkBoxDelete($id);

                if ($id == Auth::id()) {
                    $obj['options']      = $show.''.$edit;
                }else{  
                    $obj['options']      = $show.''.$edit.''.$delete;
                }
                
                $data[] = $obj;
            }
        }

        $output['data']  = $data;
        
        return Response()->json($output);
    }

    public function filter($request,$search)
    {
        $query = $this->model
                ->where(function($query) use($search) {
                    $query
                    // SEARCH IN USER TABLE
                    ->where('id'            , 'like' , '%'. $search .'%')
                    ->orWhere('full_name'   , 'like' , '%'. $search .'%')
                    ->orWhere('mobile'      , 'like' , '%'. $search .'%')
                    ->orWhere('email'       , 'like' , '%'. $search .'%')

                    // SEARCH IN ROLES TABLE
                    ->orWhereHas('roles', function ($query) use ($search){
                        $query->where('display_name', 'like', '%'.$search.'%');
                    });
                });

    
        if ($request['req']['from'] != '')
            $query->where('created_at'  , '>=' , $request['req']['from']);

        if ($request['req']['to'] != '')
            $query->where('created_at'  , '<=' , $request['req']['to']);

        if ($request['req']['active'] != '')
            $query->where('active' , $request['req']['active']);

        if ($request['req']['roles'] != ''){

            if($request['req']['roles'] == 'normal') {
                $query->doesnthave('roles');
            }else{
                $query->whereHas('roles', function ($query) use ($request){
                    $query->where('id',$request['req']['roles']);
                });
            }

        }

        return $query;
    }
}