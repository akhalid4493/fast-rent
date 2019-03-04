<?php
namespace App\TheApp\Repository\Admin\Model;

use App\Models\Models;
use DB;

class ModelReopository
{
    protected $model;

    public function __construct(Models $model)
    {
        $this->model = $model;
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
            
            $model = $this->model->create([
                    'name_ar' => $request['name_ar'],
                    'name_en' => $request['name_en'],
                    'status'  => $request['status'],
                    'brand_id'=> $request['brand_id'],
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
            
            $model = $this->findById($id);
            
            $model->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'status'  => $request['status'],
                'brand_id'=> $request['brand_id'],
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
        $model = $this->model->find($id);
        return $model->delete();
    }

    public function deleteAll($request)
    {
        return $models = $this->model->destroy($request['ids']);
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
        $models = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($models))
        {
            foreach ($models as $model)
            {
                $id = $model['id'];

                $edit= btn('edit','edit_models',url(route('models.edit',$id)));
                $delete = btn('delete','delete_models',url(route('models.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $model->name_ar;
                $obj['brand_id']     = $model->brand->name_ar;
                $obj['status']       = Status($model->status);
                $obj['created_at']   = date("d-m-Y", strtotime($model->created_at));
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

        if ($request['req']['brand_id'] != '')
            $query->where('brand_id' , $request['req']['brand_id']);

        return $query;
    }

}