<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdRequest;
use App\Http\Requests\MotorPoolRequest;
use App\Http\Requests\SearchTextRequest;
use App\Models\carConfiguration;
use App\Services\BrandService;
use App\Services\CarGroupService;
use App\Services\ModelService;
use App\Services\MotorPoolService;
use App\Services\SubjectService;
use Illuminate\Http\Request;


class MotorPoolController extends Controller
{
    private $motorPoolServ,$request;
    function __construct(MotorPoolService $motorPoolServ,Request $request)
    {
        $this->motorPoolServ = $motorPoolServ;
        $this->request = $request;
    }

    public function show()
    {
        $carsPoolObj = $this->motorPoolServ->getCars();

        return view('motorPool.motorPoolList',['carsPool' => $carsPoolObj]);
    }

    public function addMotorPoolDialog(
        BrandService $brandServ,
        ModelService $modelServ,
        SubjectService $subjectServ,
        carConfiguration $carConfigurationObj
    ){
        $brandsObj = $brandServ->getBarnds();
        $typesObj = $modelServ->getTypes();
        $ownersObj = $subjectServ->getSubjectsCarOwner();
        $subjectsObj = $subjectServ->getSubjects();
        return view('dialog.MotorPool.addCar',[
            'brands'=>$brandsObj,
            'types' => $typesObj,
            'owners' => $ownersObj,
            'subjectsObj' => $subjectsObj,
            'carConfiguration' => $carConfigurationObj,
        ]);
    }

    public function editMotorPoolDialog(
        BrandService $brandServ,
        ModelService $modelServ,
        SubjectService $subjectServ,
        CarIdRequest $carIdRequest
    ){
        $carConfigurationObj = $this->motorPoolServ->getCarFullInfo($carIdRequest->getCarId());
        $brandsObj = $brandServ->getBarnds();
        $typesObj = $modelServ->getTypes();
        $ownersObj = $subjectServ->getSubjectsCarOwner();
        $subjectsObj = $subjectServ->getSubjects();

        return view('dialog.MotorPool.addCar',[
            'brands'=>$brandsObj,
            'types' => $typesObj,
            'owners' => $ownersObj,
            'subjectsObj' => $subjectsObj,
            'carConfiguration' => $carConfigurationObj,
        ]);
    }



    public function add(MotorPoolRequest $motorPoolRequest)
    {
        $this->motorPoolServ->addCar($motorPoolRequest);
        return redirect()->back();
    }


    public function addCarToDialog()
    {
        $carsObj = $this->motorPoolServ->getLastCars(7);
        return view('dialog.Car.addCarTo',['cars'=>$carsObj]);
    }


    public function carInfoDialog(CarGroupService $carGroupServ,$carId)
    {
        $carObj = $this->motorPoolServ->getCarFullInfo($carId);
        $carGroupsObj = $carGroupServ->getCarGroupsByCar($carId);
        return view('dialog.MotorPool.carInfo',['car' => $carObj,'carGroupsObj' => $carGroupsObj]);
    }


    public function search(SearchTextRequest $searchTextObj)
    {
        $carsObj = $this->motorPoolServ->search($searchTextObj);
        return view('car.carSearchResult',['cars' => $carsObj]);
    }


    public function getCarInfo($id=null)
    {
        if ($id){
            $carId = $id;
        } else{
            $validated = $this->request->validate(['carId' => 'integer']);
            $carId = $validated['carId']??0;
        }
        $carInfo = $this->motorPoolServ->getCar($carId);
        return response()->json($carInfo);
    }

}
