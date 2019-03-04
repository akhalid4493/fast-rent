<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Feature\FeatureReopository as Feature;
use Illuminate\Http\Request;

class FeatureController extends AdminController
{
    function __construct(Feature $feature)
    {
        $this->featureModel  = $feature;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_features'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_features'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_features',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_features',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.features.home');
    }

    public function dataTable(Request $request)
    {
        return $this->featureModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.features.create');
    }

    public function store(Request $request)
    {
        $create = $this->featureModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $feature = $this->featureModel->findById($id);

        if (!$feature)
            abort(404);

        return view('admin.features.show' , compact('feature'));
    }

    public function edit($id)
    {
        $feature  = $this->featureModel->findById($id);
        
        if (!$feature)
            return abort(404);

        return view('admin.features.edit' , compact('feature'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->featureModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->featureModel->delete($id);

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
            $repose = $this->featureModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}