<?php
namespace App\TheApp\Repository\Admin\Car;

use App\TheApp\Libraries\ImgRepository;
use App\Models\Car;
use DB;

class CarReopository
{
    protected $model;

    public function __construct(Car $car)
    {
        $this->model = $car;
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
            
            $car = $this->model->create([
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
            
            $car = $this->findById($id);
            
            if ($request->hasFile('image'))
                $image = ImgRepository::uploadImage($request['image']);
            else
                $image  = $car->image;
                
            $car->update([
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
        $car = $this->model->find($id);
        return $car->delete();
    }

    public function deleteAll($request)
    {
        return $cars = $this->model->destroy($request['ids']);
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
        $cars = $query
                ->orderBy($sort['col'], $sort['dir'])
                ->skip($request->input('start'))
                ->take($request->input('length',10))
                ->get();


        $data = array();

        if(!empty($cars))
        {
            foreach ($cars as $car)
            {
                $id = $car['id'];

                $edit= btn('edit','edit_cars',url(route('cars.edit',$id)));
                $delete = btn('delete','delete_cars',url(route('cars.show',$id)));

                $obj['id']           = $id;
                $obj['name_ar']      = $car->name_ar;
                $obj['status']       = Status($car->status);
                $obj['image']        = Url($car->image);
                $obj['created_at']   = date("d-m-Y", strtotime($car->created_at));
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