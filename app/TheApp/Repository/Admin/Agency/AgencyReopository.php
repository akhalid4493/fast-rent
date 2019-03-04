<?php
namespace App\TheApp\Repository\Admin\Agency;

use App\TheApp\Libraries\ImgRepository;
use App\Models\Address;
use App\Models\Agency;
use DB;

class AgencyReopository
{
    protected $model;

    public function __construct(Agency $agency,Address $address)
    {
        $this->model = $agency;
        $this->address = $address;
    }  

    public function getAll($order = 'id', $sort = 'desc')
    {
        return $this->model->orderBy($order, $sort)->get();
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
            $image  = 'uploads/default.png';

        try {

            $agency = $this->model->create([
                    'name_ar'           => $request['name_ar'],
                    'name_en'           => $request['name_en'],
                    'description_ar'    => $request['description_ar'],
                    'description_en'    => $request['description_en'],
                    'status'            => $request['status'],
                    'user_id'           => $request['user_id'],
                    'block'             => $request['block'],
                    'street'            => $request['street'],
                    'address'           => $request['address'],
                    'province_id'       => $request['province_id'],
                    'image'             => $image
                ]);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update($request , $id)
    {
        try {
            
            $agency = $this->findById($id);
            
            if ($request->hasFile('image'))
                $image = ImgRepository::uploadImage($request['image']);
            else
                $image  = $agency->image;

            $agency->update([
                'name_ar'           => $request['name_ar'],
                'name_en'           => $request['name_en'],
                'description_ar'    => $request['description_ar'],
                'description_en'    => $request['description_en'],
                'status'            => $request['status'],
                'user_id'           => $request['user_id'],
                'province_id'       => $request['province_id'],
                'image'             => $image
            ]);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            return false;
        }
    }


    public function delete($id)
    {
        $agency = $this->model->find($id);
        return $agency->delete();
    }

    public function deleteAll($request)
    {
        return $agencies = $this->model->destroy($request['ids']);
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
        $agencies = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($agencies))
        {
            foreach ($agencies as $agency)
            {
                $id = $agency['id'];

                $edit= btn('edit','edit_agencies',url(route('agencies.edit',$id)));
                $delete = btn('delete','delete_agencies',url(route('agencies.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $agency->name_ar;
                $obj['status']       = Status($agency->status);
                $obj['image']        = Url($agency->image);
                $obj['created_at']   = date("d-m-Y", strtotime($agency->created_at));
                $obj['options']      = $edit . $delete;
                $obj['listBox']      = checkBoxDelete($id);
                
                $data[] = $obj;
            }
        }

        $output['data']  = $data;
        
        return Response()->json($output);
    }

    public function filter($request,$search)
    {
        $query = $this->model
                ->where(function($query) use($search,$request) {
                    $query
                    ->where('id'           , 'like' , '%'. $search .'%')
                    ->orWhere('name_en'    , 'like' , '%'. $search .'%')
                    ->orWhere('name_ar'    , 'like' , '%'. $search .'%')
                    ->orWhere('status'     , 'like' , '%'. $search .'%');
                });
    
        if ($request['req']['from'] != '')
            $query->where('created_at'  , '>=' , $request['req']['from']);

        if ($request['req']['to'] != '')
            $query->where('created_at'  , '<=' , $request['req']['to']);

        if ($request['req']['status'] != '')
            $query->where('status' , $request['req']['status']);

        return $query;
    }

}