<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Repositories\EventRentalRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\EventRentalService;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;

class EventRentalController extends Controller
{
    protected $rentEventRep,$request,$eventObj,$eventRentalServ;

    public function __construct(
        RentEventRepository $rentEventRep,
        Request $request,
        EventRentalService $eventRentalServ,
        EventRentalRepository $eventRentalRep
    ){
        $this->rentEventRep = $rentEventRep;
        $this->request = $request;
        $rc = new \ReflectionClass($this);
        $eventObj = $rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj = $eventObj;
        $this->eventRentalServ = $eventRentalServ;
    }


    public function index(DateSpan $dateSpan,EventRentalService $eventRentalServ)
    {
        $dateSpan->validated();
        $periodDate = $dateSpan->getCarbonPeriod();
        $eventsObj = $eventRentalServ->getEvents($periodDate,$this->eventObj->id);
        return view('rentEvent.listEventsRental',['eventsObj' => $eventsObj]);
    }


    public function create(
        NeedParent $needParent,
        CarIdDate $carIdDate,
        MotorPoolService $motorPoolServ,
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep
    ){
        $nP = $needParent->validated();
        $contractObj=$contractRep->getContract($carIdDate->get('contractId'));
        if ($contractObj->carId){
            $carObj=$motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj=$motorPoolServ->getCar($carIdDate->get('carId'));
        }

        $lastTimeSheetObj = $timeSheetRep->getLastTimeSheet($carObj,$this->eventObj);
        //echo $lastEvent->dateTime;
        return view('rentEvent.addEventRental',[
            'carObj' => $carObj,
            'needParent' => $nP['needParent'],
            'contractObj' => $contractObj,
            'dateTime' => $carIdDate->get('date'),
            'eventObj' => $this->eventObj,
            'lastTimeSheet' => $lastTimeSheetObj,
        ]);
    }


    public function store(EventRentalService $eventRentalServ)
    {
        $inputData=$this->request->validate([
            'carId'=>'integer|required',
            'dateStart'=>'required',
            'timeStart'=>'required',
            'dateFinish'=>'required',
            'timeFinish'=>'required',
            'sum'=>'array',
            'contractId'=>'required']);

        $inputData['eventId']= $this->eventObj->id;
        $inputData['color']=$this->eventObj->color;
        $inputData['duration']=$this->eventObj->duration;
        $eventRentalServ->addEvent($inputData);
        return redirect('/timesheet/list');
    }


    public function show($id,EventRentalService $eventRentalServ)
    {
        $eventRentalObj = $eventRentalServ->getEventRentalInfo($this->eventObj->id,$id);
        return view('dialog.RentEvent.infoEventRental',['eventRentalObj' => $eventRentalObj]);
        //echo $id;
    }


    public function edit($id)
    {
        //
    }


    public function update($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
