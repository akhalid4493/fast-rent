<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Model\ModelReopository as Model;
use App\TheApp\Repository\Admin\Brand\BrandReopository as Brand;
use Illuminate\Http\Request;

class ModelController extends  AdminController
{
    function __construct(Model $model,Brand $brand)
    {
        $this->modelModel  = $model;
        $this->brandModel  = $brand;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_models',['only' => ['show', 'index']]);
        $this->middleware('permission:add_models' ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_models',['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_models',['only' => ['destroy']]);
    }

    public function index()
    {
        $brands = $this->brandModel->getAll();
        return view('admin.models.home',compact('brands'));
    }

    public function dataTable(Request $request)
    {
        return $this->modelModel->dataTable($request);
    }

    public function create()
    {
        $brands = $this->brandModel->getAll();
        return view('admin.models.create',compact('brands'));
    }

    public function store(Request $request)
    {
        $create = $this->modelModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);
    }


    public function show($id)
    {
        $model = $this->modelModel->findById($id);

        if (!$model)
            abort(404);

        return view('admin.models.show' , compact('model'));
    }

    public function edit($id)
    {
        $brands = $this->brandModel->getAll();
        $model  = $this->modelModel->findById($id);
        
        if (!$model)
            return abort(404);

        return view('admin.models.edit' , compact('model','brands'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->modelModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->modelModel->delete($id);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }

    public function deletes(Request $request)
    {
        try {
            $repose = $this->modelModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}