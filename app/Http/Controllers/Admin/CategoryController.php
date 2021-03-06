<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Category\CategoryReopository as Category;
use Illuminate\Http\Request;

class CategoryController extends AdminController
{
    function __construct(Category $category)
    {
        $this->categoryModel  = $category;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_categories'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_categories'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_categories',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_categories',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.categories.home');
    }

    public function dataTable(Request $request)
    {
        return $this->categoryModel->dataTable($request);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $create = $this->categoryModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $category = $this->categoryModel->findById($id);

        if (!$category)
            abort(404);

        return view('admin.categories.show' , compact('category'));
    }

    public function edit($id)
    {
        $category  = $this->categoryModel->findById($id);
        
        if (!$category)
            return abort(404);

        return view('admin.categories.edit' , compact('category'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->categoryModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);
        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->categoryModel->delete($id);

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
            $repose = $this->categoryModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}