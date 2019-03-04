<?php

namespace App\Http\Controllers\Admin;

use App\TheApp\Repository\Admin\Transmission\TransmissionReopository as Transmission;
use App\TheApp\Repository\Admin\Condition\ConditionReopository as Condition;
use App\TheApp\Repository\Admin\Category\CategoryReopository as Category;
use App\TheApp\Repository\Admin\Agency\AgencyReopository as Agency;
use App\TheApp\Repository\Admin\Color\ColorReopository as Color;
use App\TheApp\Repository\Admin\Model\ModelReopository as Model;
use App\TheApp\Repository\Admin\Brand\BrandReopository as Brand;
use App\TheApp\Repository\Admin\Fuel\FuelReopository as Fuel;
use App\TheApp\Repository\Admin\Car\CarReopository as Car;
use Illuminate\Http\Request;

class CarController extends AdminController
{
    function __construct(
                        Car $car,
                        Transmission $transmission,
                        Condition $condition,
                        Category $category,
                        Color $color,
                        Model $model,
                        Brand $brand,
                        Fuel $fuel,
                        Agency $agency
                        )
    {
        $this->carModel           = $car;
        $this->transmissionModel  = $transmission;
        $this->conditionModel     = $condition;
        $this->colorModel         = $color;
        $this->modelModel         = $model;
        $this->brandModel         = $brand;
        $this->fuelModel          = $fuel;
        $this->agencyModel        = $agency;

        // PERMISSION OF USER FUNCTIONS
        $this->middleware('permission:show_cars'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_cars'   ,['only' => ['create' , 'store']]);
        $this->middleware('permission:edit_cars',['only' => ['edit'   , 'update']]);
        $this->middleware('permission:delete_cars',['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.cars.home');
    }

    public function dataTable(Request $request)
    {
        return $this->carModel->dataTable($request);
    }

    public function create()
    {
        $transmission   = $this->transmissionModel->getAll(); ;
        $condition      = $this->conditionModel->getAll(); $condition;
        $color          = $this->colorModel->getAll(); ;
        $models         = $this->modelModel->getAll();
        $brands         = $this->brandModel->getAll();
        $fuel           = $this->fuelModel ->getAll();
        $agencies       = $this->agencyModel->getAll();

        return view('admin.cars.create',
               compact('transmission','condition','color','models','brands','fuel','agencies'));
    }

    public function store(Request $request)
    {
        $create = $this->carModel->create($request);

        if($create)
            return Response()->json([true , 'تم الاضافة بنجاح' ]);
        
        return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

    }


    public function show($id)
    {
        $car = $this->carModel->findById($id);

        if (!$car)
            abort(404);

        return view('admin.cars.show' , compact('car'));
    }

    public function edit($id)
    {
        $car  = $this->carModel->findById($id);
        
        if (!$car)
            return abort(404);

        return view('admin.cars.edit' , compact('car'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()){
            $update = $this->carModel->update($request , $id);

            if($update){
                return Response()->json([true , 'تم التعديل بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }
    }

    public function destroy($id)
    {
        try {
            $repose = $this->carModel->delete($id);

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
            $repose = $this->carModel->deleteAll($request);

            if($repose){
                return Response()->json([true, 'تم الحذف بنجاح']);
            }
            return Response()->json([false  , 'حدث خطا ، حاول مره اخرى']);

        }catch (\PDOException $e){
            return Response()->json([false, $e->errorInfo[2]]);
        }
    }
}