<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Condition\ConditionReopository as Condition;
use Illuminate\Http\Request;

class ConditionController extends AdminController
{
    function __construct(Condition $condition)
    {
        $this->conditionModel  = $condition;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_conditions'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_conditions'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_conditions',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_conditions',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.conditions.home');
    }

    public function dataTable(Request $request)
    {
        return $this->conditionModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.conditions.create');
    }

    public function store(Request $request)
    {
        $create = $this->conditionModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $condition = $this->conditionModel->findById($id);

        if (!$condition)
            abort(404);

        return view('admin.conditions.show' , compact('condition'));
    }

    public function edit($id)
    {
        $condition  = $this->conditionModel->findById($id);
        
        if (!$condition)
            return abort(404);

        return view('admin.conditions.edit' , compact('condition'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->conditionModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->conditionModel->delete($id);

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
            $repose = $this->conditionModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}