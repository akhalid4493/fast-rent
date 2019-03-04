<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Governorates\GovernorateRepository as Governorate;
use App\TheApp\Repository\Admin\Provinces\ProvinceRepository as Province;
use App\TheApp\Repository\Admin\Agency\AgencyReopository as Agency;
use App\TheApp\Repository\Admin\Users\UserRepository as User;
use Illuminate\Http\Request;

class AgenciesController extends AdminController
{
    function __construct(Agency $agency,User $user,Governorate $governorate,Province $province)
    {
        $this->agencyModel          = $agency;
        $this->userModel            = $user;
        $this->governorateModel     = $governorate;
        $this->provinceModel        = $province;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_agencies'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_agencies'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_agencies',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_agencies',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.agencies.home');
    }

    public function dataTable(Request $request)
    {
        return $this->agencyModel->dataTable($request);
    }

    public function create()
    {
        $users       = $this->userModel->notHasAgency();
        $governorats = $this->governorateModel->getAll();
        return view('admin.agencies.create',compact('users','governorats'));
    }

    public function store(Request $request)
    {
        $create = $this->agencyModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $agency = $this->agencyModel->findById($id);

        if (!$agency)
            abort(404);

        return view('admin.agencies.show' , compact('agency'));
    }

    public function edit($id)
    {
        $users          = $this->userModel->getAll();
        $agency         = $this->agencyModel->findById($id);
        $governorats    = $this->governorateModel->getAll();
        
        if (!$agency)
            return abort(404);

        return view('admin.agencies.edit' , compact('agency','users','governorats'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->agencyModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->agencyModel->delete($id);

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
            $repose = $this->agencyModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}