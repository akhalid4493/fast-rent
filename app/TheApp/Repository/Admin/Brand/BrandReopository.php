<?php
namespace App\TheApp\Repository\Admin\Brand;

use App\TheApp\Libraries\ImgRepository;
use App\Models\Brand;
use DB;

class BrandReopository
{
    protected $model;

    public function __construct(Brand $brand)
    {
        $this->model = $brand;
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
            
            $brand = $this->model->create([
                    'name_ar' => $request['name_ar'],
                    'name_en' => $request['name_en'],
                    'status'  => $request['status'],
                    'image'   => $image
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
            
            $brand = $this->findById($id);
            
            if ($request->hasFile('image'))
                $image = ImgRepository::uploadImage($request['image']);
            else
                $image  = $brand->image;
                
            $brand->update([
                'name_ar' => $request['name_ar'],
                'name_en' => $request['name_en'],
                'status'  => $request['status'],
                'image'   => $image
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
        $brand = $this->model->find($id);
        return $brand->delete();
    }

    public function deleteAll($request)
    {
        return $brands = $this->model->destroy($request['ids']);
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
        $brands = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($brands))
        {
            foreach ($brands as $brand)
            {
                $id = $brand['id'];

                $edit= btn('edit','edit_brands',url(route('brands.edit',$id)));
                $delete = btn('delete','delete_brands',url(route('brands.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $brand->name_ar;
                $obj['status']       = Status($brand->status);
                $obj['image']        = Url($brand->image);
                $obj['created_at']   = date("d-m-Y", strtotime($brand->created_at));
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