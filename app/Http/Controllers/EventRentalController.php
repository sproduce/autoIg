<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\EventRentalService;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;

class EventRentalController extends Controller
{
    protected $rentEventRep,$request,$eventObj;

    public function __construct(RentEventRepository $rentEventRep,Request $request)
    {
        $this->rentEventRep = $rentEventRep;
        $this->request=$request;
        $rc= new \ReflectionClass($this);
        $eventObj=$rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj=$eventObj;
    }


      public function index(DateSpan $dateSpan,EventRentalService $eventRentalServ)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
        $eventsObj=$eventRentalServ->getEvents($periodDate,$this->eventObj->id);
        return view('rentEvent.listEventsRental',['eventsObj' => $eventsObj]);
    }


    public function create(CarIdDate $carIdDate,MotorPoolService $motorPoolServ,ContractRepositoryInterface $contractRep)
    {
        $inputData=$carIdDate->validated();
        $contractObj=$contractRep->getContract($inputData['contractId']);
        if ($contractObj->carId){
            $carObj=$motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj=$motorPoolServ->getCar($inputData['carId']);
        }
        return view('rentEvent.addEventRental',['carObj' => $carObj,
                                                                 'contractObj' => $contractObj,
                                                                 'dateTime'=> $inputData['date'],
                                                                 'eventObj'=>$this->eventObj]);
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
