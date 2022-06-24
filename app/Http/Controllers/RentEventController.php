<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Repositories\PaymentRepository;
use App\Services\ContractService;
use App\Services\MotorPoolService;
use App\Services\RentEventService;
use Illuminate\Http\Request;


class RentEventController extends Controller
{
    private $request,$rentEventServ,$motorPoolServ,$contractServ;



    public function __construct(Request $request,RentEventService $rentEventServ,MotorPoolService $motorPoolServ,ContractService $contractServ)
    {
        $this->request = $request;
        $this->rentEventServ = $rentEventServ;
        $this->motorPoolServ = $motorPoolServ;
        $this->contractServ = $contractServ;
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
        $eventDataObj = $serviceObj->getEventModel();

        $viewDataArray = [
            'carObj' => $this->motorPoolServ->getCar($carIdDate->get('carId')),
            'contractObj' => $this->contractServ->getContract($carIdDate->get('contractId')),
            'needParent' => $needParent['needParent'],
            'dateTime' => $carIdDate->get('date'),
            'eventObj' => $eventObj,
            'eventDataObj' => $eventDataObj,
            ];

        $additionalDataArray = $serviceObj->getAdditionalViewDataArray();


//        $viewAdditionalArray = $serviceObj->getAdditionalViewDataArray();
//        $viewArray = array_merge($viewDataArray,$viewAdditionalArray);
        return view('rentEvent.'.$eventObj->action.'.add',$viewDataArray);
    }


    public function store($eventId)
    {
        $eventObj = $this->rentEventServ->getRentEvent($eventId);

        $serviceObj = $this->rentEventServ->getEventService($eventObj);
        $validateRules = $serviceObj->getRequestRules();

        $requestObj = \App\Http\Requests\Event\OtherRequest::createFromGlobals();


        $requestObj->validated();

        //$requestObj->validated();

        //var_dump($requestObj);

//        $validateData = $this->request->validate($validateRules);
//        var_dump($validateData);
    }












    public function show()
    {
        $rentEventsObj=$this->rentEventServ->getRentEvents();
        return view('rentEvent.rentEventList',['rentEvents'=>$rentEventsObj]);
    }


    public function addDialog()
    {
        return view('dialog.RentEvent.addRentEvent');
    }

    public function add()
    {
        $validate=$this->request->validate(['name'=>'required',
            'color'=>'required',
            'action'=>'required'
        ]);

        $this->rentEventServ->addRentEvent($validate);
        return  redirect()->back();
    }


    public function editDialog(PaymentRepository $paymentRep)
    {
        $event=$this->request->validate(['eventId'=>'required']);
        $rentEventObj=$this->rentEventServ->getRentEvent($event['eventId']);
        $paymentTypes=$paymentRep->getOperationTypes();
        return view('dialog.RentEvent.editRentEvent',['rentEventObj' => $rentEventObj,
            'paymentTypes' => $paymentTypes]);
    }


    public function update()
    {
        $eventArray=$this->request->validate(['id' => 'required',
            'name' => '',
            'color' => '',
            'action' =>'',
            'priority' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'isToPay' => 'nullable',
            'payOperationTypeId' => 'integer'
            ]);
        $this->rentEventServ->updateRentEvent($eventArray);

        return  redirect()->back();
    }

}
