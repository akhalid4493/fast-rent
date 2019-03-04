<?php
namespace App\TheApp\Repository\Admin\Transmission;

use App\Models\Transmission;
use DB;

class TransmissionReopository
{
    protected $model;

    public function __construct(Transmission $transmission)
    {
        $this->model = $transmission;
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
        
        try {
            
            $transmission = $this->model->create([
                    'name_ar' => $request['name_ar'],
                    'name_en' => $request['name_en'],
                    'status'  => $request['status'],
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
            
            $transmission = $this->findById($id);
            
            $transmission->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'status'  => $request['status'],
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
        $transmission = $this->model->find($id);
        return $transmission->delete();
    }

    public function deleteAll($request)
    {
        return $transmissions = $this->model->destroy($request['ids']);
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
        $transmissions = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($transmissions))
        {
            foreach ($transmissions as $transmission)
            {
                $id = $transmission['id'];

                $edit= btn('edit','edit_transmission',url(route('transmissions.edit',$id)));
                $delete = btn('delete','delete_transmission',url(route('transmissions.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $transmission->name_ar;
                $obj['status']       = Status($transmission->status);
                $obj['created_at']   = date("d-m-Y", strtotime($transmission->created_at));
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