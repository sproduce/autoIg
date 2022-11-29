<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Imports\GibddFineImport;
use App\Repositories\PaymentRepository;
use App\Services\ContractService;
use App\Services\MotorPoolService;
use App\Services\RentEventService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\PhotoService;



class RentEventController extends Controller
{
    private $request,$rentEventServ,$motorPoolServ,$contractServ,$photoServ;



    public function __construct(Request $request,RentEventService $rentEventServ,MotorPoolService $motorPoolServ,ContractService $contractServ,PhotoService $photoServ)
    {
        $this->request = $request;
        $this->rentEventServ = $rentEventServ;
        $this->motorPoolServ = $motorPoolServ;
        $this->contractServ = $contractServ;
        $this->photoServ = $photoServ;
    }


    public function index($eventId,DateSpan $dateSpan)
    {
        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $eventResult = $serviceObj->index($dateSpan->getCarbonPeriod());

        return view('rentEvent.'.$eventObj->action.'.list',['listEventsObj'=>$eventResult,'eventObj'=>$eventObj]);
    }


    public function create($eventId,
                           NeedParent $needParent,
                           CarIdDate $carIdDate
    ){
        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $eventDataObj = $serviceObj->getEventInfo(null);

        $carObj = $this->motorPoolServ->getCar($carIdDate->get('carId'));
        $additionalDataArray = $serviceObj->getAdditionalViewDataArray();

        $viewDataArray = [
            'carObj' => $carObj,
            'contractObj' => $this->contractServ->getContract($carIdDate->get('contractId')),
            'needParent' => $needParent['needParent'],
            'dateTime' => $carIdDate->get('date'),
            'eventObj' => $eventObj,
            'eventDataObj' => $eventDataObj,
            'additionalDataArray' => $additionalDataArray,
            'parentId' => $carIdDate->get('parentId'),
            ];

        //$additionalDataArray = $serviceObj->getAdditionalViewDataArray();

//        $viewAdditionalArray = $serviceObj->getAdditionalViewDataArray();
//        $viewArray = array_merge($viewDataArray,$viewAdditionalArray);
        return view('rentEvent.'.$eventObj->action.'.add',$viewDataArray);
    }


    public function store($eventId)
    {
        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $timeSheetObj = $serviceObj->store();
        
        if ($this->request->file('file')&&$timeSheetObj->id)
        {
            $this->photoServ->savePhoto($this->request->file('file'), $timeSheetObj->uuid);
        }
       
        return redirect('/timesheet/listByEvent');
    }

    public function edit($eventId,$dataId, NeedParent $needParent,
                         CarIdDate $carIdDate)
    {

        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $eventDataObj = $serviceObj->getEventInfo($dataId);

        $viewDataArray = [
            'carObj' => $this->motorPoolServ->getCar($carIdDate->get('carId')),
            'contractObj' => $this->contractServ->getContract($carIdDate->get('contractId')),
            'needParent' => $needParent['needParent'],
            'dateTime' => $carIdDate->get('date'),
            'eventObj' => $eventObj,
            'eventDataObj' => $eventDataObj,
        ];
        return view('rentEvent.'.$eventObj->action.'.add',$viewDataArray);
    }

    public function show($eventId,$dataId)
    {
        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $eventDataObj = $serviceObj->getEventInfo($dataId);
        $eventFilesObj = $this->photoServ->getFiles($eventDataObj->uuid);
        $viewDataArray = [
            'eventObj' => $eventObj,
            'eventDataObj' => $eventDataObj,
            'filesObj' =>$eventFilesObj,
            ];
        return view('rentEvent.'.$eventObj->action.'.info',$viewDataArray);
    }



    public function destroy($eventId,$dataId)
    {
        $eventObj = $this->rentEventServ->getRentEvent($eventId);
        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $serviceObj->destroy($dataId);
        return redirect('/timesheet/list');
    }



    public function list()
    {
        $rentEventsObj = $this->rentEventServ->getRentEvents();

        return view('rentEvent.rentEventList',['rentEvents'=>$rentEventsObj]);
    }


    public function addDialog()
    {
        return view('dialog.RentEvent.addRentEvent');
    }

    public function add()
    {
        $validate = $this->request->validate(['name'=>'required',
            'color' => 'required',
            'action' => 'required'
        ]);

        $this->rentEventServ->addRentEvent($validate);
        return  redirect()->back();
    }


    public function editDialog(PaymentRepository $paymentRep)
    {
        $event = $this->request->validate(['eventId'=>'required']);
        $rentEventObj = $this->rentEventServ->getRentEvent($event['eventId']);
        $paymentTypes = $paymentRep->getOperationTypes();
        return view('dialog.RentEvent.editRentEvent',['rentEventObj' => $rentEventObj,
            'paymentTypes' => $paymentTypes]);
    }


    public function update()
    {
        $eventArray = $this->request->validate([
            'id' => 'required',
            'name' => '',
            'color' => '',
            'colorPay' => '',
            'colorPartPay' => '',
            'action' =>'',
            'priority' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'visibleTimeSheet' => 'nullable|boolean',
            'payOperationTypeId' => 'integer',
            ]);
        $this->rentEventServ->updateRentEvent($eventArray);

        return  redirect()->back();
    }


    public function swert()
    {
       echo "1";
    }
    
    public function test()
    {

        //$requestFine = new FineRequest();
        //app()->make(Event\FineRequest::class);
        //$requestFine->replace(['sum1'=>'q']);
        //$requestFine->validated();
        //echo $requestFine->get('sum');
        //echo "test";
        
        
         //$result = Excel::toArray(new FineImport(),'fine.xls');
        //$array = Excel::toArray(new FineImport(),'fine.xls');
        //$array = (new FineImport)->toCollection('fine.xls');
        //$array = (new FineImport)->toArray('fine.xls');
//        $import = new \App\Imports\GibddFineImport();
//        $import->import('fine.xls');
$gibddFineRep = new \App\Repositories\GibddFineRepository();
        Excel::import(new GibddFineImport($gibddFineRep),'fine.xls');
        //echo  strtotime(0000-00-00);
        //var_dump($result);
    }


}
