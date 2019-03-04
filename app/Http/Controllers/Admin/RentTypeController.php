<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\RentType\RentTypeReopository as RentType;
use Illuminate\Http\Request;

class RentTypeController extends AdminController
{
    function __construct(RentType $type)
    {
        $this->typeModel  = $type;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_rent_types'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_rent_types'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_rent_types',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_rent_types',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.rent_types.home');
    }

    public function dataTable(Request $request)
    {
        return $this->typeModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.rent_types.create',compact('perms'));
    }

    public function store(Request $request)
    {
        $create = $this->typeModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $type = $this->typeModel->findById($id);

        if (!$type)
            abort(404);

        return view('admin.rent_types.show' , compact('type'));
    }

    public function edit($id)
    {
        $type  = $this->typeModel->findById($id);
        
        if (!$type)
            return abort(404);

        return view('admin.rent_types.edit' , compact('type'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->typeModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->typeModel->delete($id);

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
            $repose = $this->typeModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}