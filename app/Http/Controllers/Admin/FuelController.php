<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Fuel\FuelReopository as Fuel;
use Illuminate\Http\Request;

class FuelController extends AdminController
{
    function __construct(Fuel $fuel)
    {
        $this->fuelModel  = $fuel;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_fuels'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_fuels'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_fuels',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_fuels',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.fuels.home');
    }

    public function dataTable(Request $request)
    {
        return $this->fuelModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.fuels.create',compact('perms'));
    }

    public function store(Request $request)
    {
        $create = $this->fuelModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $fuel = $this->fuelModel->findById($id);

        if (!$fuel)
            abort(404);

        return view('admin.fuels.show' , compact('fuel'));
    }

    public function edit($id)
    {
        $fuel  = $this->fuelModel->findById($id);
        
        if (!$fuel)
            return abort(404);

        return view('admin.fuels.edit' , compact('fuel'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->fuelModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->fuelModel->delete($id);

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
            $repose = $this->fuelModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}