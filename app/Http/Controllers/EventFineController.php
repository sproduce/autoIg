<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\EventFineRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Services\EventFineService;
use App\Services\MotorPoolService;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Requests\Event;

class EventFineController extends Controller
{
    protected $rentEventRep,$eventObj,$eventFineServ;

    public function __construct(RentEventRepositoryInterface $rentEventRep,EventFineService $eventFineServ)
    {
        $this->eventFineServ = $eventFineServ;
        $this->rentEventRep = $rentEventRep;
        $rc = new \ReflectionClass($this);
        $eventObj = $rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj = $eventObj;
    }


    public function index(DateSpan $dateSpan,EventFineService $eventFineServ)
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        $listEventsObj = $eventFineServ->getEvents($periodDate,$this->eventObj->id);

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
        $contractObj = $contractRep->getContract($carIdDate['contractId']);
        if ($contractObj->carId) {
            $carObj = $motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj = $motorPoolServ->getCar($carIdDate['carId']);
        }

        return response()->view('rentEvent.addEventFine',[
            'needParent' => $needParent['needParent'],
            'carObj' => $carObj,
            'contractObj' => $contractObj,
            'dateTime' => $carIdDate['date'],
            'eventObj' => $this->eventObj,
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
    public function edit($id)
    {
           $eventFullInfo = $this->eventFineServ->getEventFullInfo($id,$this->eventObj);

        //echo $eventFineObj->timeSheet->carId;

        return response()->view('rentEvent.addEventFine',[
            'needParent' => '0',
            'eventObj' => $this->eventObj,
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
    public function update(Request $request, $id)
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
