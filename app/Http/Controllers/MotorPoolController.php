<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdRequest;
use App\Http\Requests\MotorPoolRequest;
use App\Http\Requests\Search\SearchCarRequest;
use App\Http\Requests\NeedParent;

use App\Models\carConfiguration;
use App\Services\BrandService;
use App\Services\CarGroupService;
use App\Services\ModelService;
use App\Services\MotorPoolService;
use App\Services\SubjectService;
use App\Services\TimeSheetService;
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


    public function carInfoDialog(NeedParent $needParent, TimeSheetService $timeSheetServ, CarGroupService $carGroupServ, $carId)
    {
        $carObj = $this->motorPoolServ->getCarFullInfo($carId);
        $carGroupsObj = $carGroupServ->getCarGroupsByCar($carId);
        //$carModel = $this->motorPoolServ->getCar($carId);
        $carPts = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventPts'));
        $carSts = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventSts'));
        $carOsago = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventOsago'));
        $carKasko = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventKasko'));
        $carDiagnosticCard = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventDiagnosticCard'));
        $carProxy = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventProxy'));
        $carLicense = $timeSheetServ->getCarEvents($carId,config('rentEvent.eventLicense'));
        
        if ($needParent->get('needParent')){
            $fileView = 'motorPool.carInfo';
        } else {
            $fileView = 'dialog.MotorPool.carInfo';
        }
        
        
        return view($fileView,[
            'car' => $carObj,
            'carGroupsObj' => $carGroupsObj,
            'carSts' => $carSts,
            'carPts' => $carPts,
            'carOsago' => $carOsago,
            'carKasko' => $carKasko,
            'carDiagnosticCard' => $carDiagnosticCard,
            'carProxy' => $carProxy,
            'carLicense' => $carLicense,
        ]);
    }


    public function search(SearchCarRequest $searchTextObj)
    {
        $carsObj = $this->motorPoolServ->search($searchTextObj);
        return view('car.carSearchResult',['cars' => $carsObj]);
    }


    public function getCarInfo($id = null)
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


    
    public function editCarNicknameDialog($id) 
    {
        $carObj = $this->motorPoolServ->getCar($id);
        return view('dialog.MotorPool.editNickname',['car' => $carObj]);
    }
    
    
    public function editCarNickname() 
    {
        $validated = $this->request->validate(['id' => 'integer','nickname' => '']);
        //echo $validated['id'];
        $this->motorPoolServ->changeNickname($validated['id'], $validated['nickname']);
        return redirect()->back();
    }
    
    
    
    public function getCarFullInfo($id)
    {
        $carObj = $this->motorPoolServ->getCarFullInfo($id);
        return response()->json($carObj);
    }

    public function getCarRentFrom($carId,carConfiguration $motorPoolCar)
    {
        $carInfoObj = $this->motorPoolServ->getCar($carId);
        return response()->json($carInfoObj->subjectFrom);
    }

}
