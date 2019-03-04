<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Brand\BrandReopository as Brand;
use Illuminate\Http\Request;

class BrandController extends AdminController
{
    function __construct(Brand $brand)
    {
        $this->brandModel  = $brand;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_brands'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_brands'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_brands',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_brands',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.brands.home');
    }

    public function dataTable(Request $request)
    {
        return $this->brandModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.brands.create',compact('perms'));
    }

    public function store(Request $request)
    {
        $create = $this->brandModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $brand = $this->brandModel->findById($id);

        if (!$brand)
            abort(404);

        return view('admin.brands.show' , compact('brand'));
    }

    public function edit($id)
    {
        $brand  = $this->brandModel->findById($id);
        
        if (!$brand)
            return abort(404);

        return view('admin.brands.edit' , compact('brand'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->brandModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->brandModel->delete($id);

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
            $repose = $this->brandModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}