<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\EventRentalService;
use App\Services\MotorPoolService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
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


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DateSpan $dateSpan,EventRentalService $eventRentalServ)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
        $eventsObj=$eventRentalServ->getEvents($periodDate,$this->eventObj->id);
        return response()->view('rentEvent.listEventsRental',['eventsObj' => $eventsObj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CarIdDate $carIdDate,MotorPoolService $motorPoolServ,ContractRepositoryInterface $contractRep)
    {
        $inputData=$carIdDate->validated();
        $contractObj=$contractRep->getContract($inputData['contractId']);
        if ($contractObj->carId){
            $carObj=$motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj=$motorPoolServ->getCar($inputData['carId']);
        }
        return response()->view('rentEvent.addEventRental',['carObj' => $carObj,
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
            'contractId'=>'']);

        $inputData['eventId']= $this->eventObj->id;
        $inputData['color']=$this->eventObj->color;
        $inputData['duration']=$this->eventObj->duration;
        $eventRentalServ->addEvent($inputData);
        return redirect('/timesheet/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
