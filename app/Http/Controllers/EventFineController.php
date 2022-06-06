<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Models\rentEventFine;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\EventFineRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Services\EventFineService;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;
use App\Http\Requests\Event;

class EventFineController extends Controller
{
    protected $rentEventRep,$eventObj,$eventFineServ,$eventFineModel;

    public function __construct(
        RentEventRepositoryInterface $rentEventRep,
        EventFineService $eventFineServ,
        rentEventFine $eventFineModel
    ){
        $this->eventFineServ = $eventFineServ;
        $this->rentEventRep = $rentEventRep;
        $this->eventFineModel = $eventFineModel;
        $rc = new \ReflectionClass($this);
        $eventObj = $rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj = $eventObj;
    }


    public function index(DateSpan $dateSpan)
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        $listEventsObj = $this->eventFineServ->getEvents($periodDate,$this->eventObj->id);

        return view('rentEvent.listEventsFine',[
            'listEventsObj' => $listEventsObj,
            'eventObj' => $this->eventObj,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(
        NeedParent $needParent,
        CarIdDate $carIdDate,
        MotorPoolService $motorPoolServ,
        ContractRepositoryInterface $contractRep
    ){

        $carObj = $motorPoolServ->getCar($carIdDate->getCarId());
        $contractObj=$contractRep->getContract($carIdDate->get('contractId'));
        return response()->view('rentEvent.addEventFine',[
            'needParent' => $needParent['needParent'],
            'contractObj' =>  $contractObj,
            'dateTime' => $carIdDate->get('date'),
            'carObj' => $carObj,
            'eventFineObj' => $this->eventFineModel,
        ]);
    }

    public function store(Event\FineRequest $fineRequest,EventFineService $eventFineServ)
    {
              $eventFineServ->addEvent($fineRequest,$this->eventObj);

        return redirect('/timesheet/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,EventFineRepositoryInterface $eventFineRep)
    {
        $eventFineObj = $eventFineRep->getEventFine($id);

        return response()->view('dialog.RentEvent.infoEventFine',['eventFineObj' => $eventFineObj]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $eventFineObj = $this->eventFineModel->find($id);
        $timeSheetObj = $timeSheetRep->getTimeSheetByEvent($this->eventObj,$id);
        return response()->view('rentEvent.addEventFine',[
            'needParent' => 1,
            'dateTime' =>  $timeSheetObj->dateTime,
            'carObj' => $timeSheetObj->car,
            'eventFineObj' => $eventFineObj,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Event\FineRequest $fineRequest, $id)
    {
        $this->eventFineServ->addEvent($fineRequest,$this->eventObj);
        return redirect('/timesheet/listByEvent?eventId='.$this->eventObj->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo "asdasd";
    }
}
