<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Transmission\TransmissionReopository as Transmission;
use Illuminate\Http\Request;

class TransmissionController extends AdminController
{
    function __construct(Transmission $transmission)
    {
        $this->transmissionModel  = $transmission;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_transmission',['only' => ['show', 'index']]);
        $this->middleware('permission:add_transmission' ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_transmission',['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_transmission',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.transmissions.home');
    }

    public function dataTable(Request $request)
    {
        return $this->transmissionModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.transmissions.create',compact('perms'));
    }

    public function store(Request $request)
    {
        $create = $this->transmissionModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $transmission = $this->transmissionModel->findById($id);

        if (!$transmission)
            abort(404);

        return view('admin.transmissions.show' , compact('transmission'));
    }

    public function edit($id)
    {
        $transmission  = $this->transmissionModel->findById($id);
        
        if (!$transmission)
            return abort(404);

        return view('admin.transmissions.edit' , compact('transmission'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->transmissionModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->transmissionModel->delete($id);

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
            $repose = $this->transmissionModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}