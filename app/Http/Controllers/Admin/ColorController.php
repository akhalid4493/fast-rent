<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Color\ColorReopository as Color;
use Illuminate\Http\Request;

class ColorController extends AdminController
{
    function __construct(Color $color)
    {
        $this->colorModel  = $color;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_colors'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_colors'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_colors',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_colors',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.colors.home');
    }

    public function dataTable(Request $request)
    {
        return $this->colorModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.colors.create');
    }

    public function store(Request $request)
    {
        $create = $this->colorModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $color = $this->colorModel->findById($id);

        if (!$color)
            abort(404);

        return view('admin.colors.show' , compact('color'));
    }

    public function edit($id)
    {
        $color  = $this->colorModel->findById($id);
        
        if (!$color)
            return abort(404);

        return view('admin.colors.edit' , compact('color'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->colorModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->colorModel->delete($id);

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
            $repose = $this->colorModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}