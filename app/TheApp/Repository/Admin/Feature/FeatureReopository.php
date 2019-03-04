<?php
namespace App\TheApp\Repository\Admin\Feature;

use App\Models\Feature;
use DB;

class FeatureReopository
{
    protected $model;

    public function __construct(Feature $feature)
    {
        $this->model = $feature;
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
            
            $feature = $this->model->create([
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
            
            $feature = $this->findById($id);
            
            $feature->update([
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
        $feature = $this->model->find($id);
        return $feature->delete();
    }

    public function deleteAll($request)
    {
        return $features = $this->model->destroy($request['ids']);
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
        $features = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($features))
        {
            foreach ($features as $feature)
            {
                $id = $feature['id'];

                $edit= btn('edit','edit_features',url(route('features.edit',$id)));
                $delete = btn('delete','delete_features',url(route('features.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $feature->name_ar;
                $obj['status']       = Status($feature->status);
                $obj['created_at']   = date("d-m-Y", strtotime($feature->created_at));
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