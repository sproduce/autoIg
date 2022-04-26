<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
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
    protected $rentEventRep,$eventObj;

    public function __construct(RentEventRepositoryInterface $rentEventRep)
    {
        $this->rentEventRep = $rentEventRep;
        $rc= new \ReflectionClass($this);
        $eventObj=$rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj=$eventObj;
    }


    public function index(DateSpan $dateSpan,EventFineService $eventFineServ)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
        $eventsObj=$eventFineServ->getEvents($periodDate,$this->eventObj->id);
        return view('rentEvent.listEventsFine',['eventsObj' => $eventsObj]);
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
        if ($contractObj->carId) {
            $carObj=$motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj=$motorPoolServ->getCar($inputData['carId']);
        }

        return response()->view('rentEvent.addEventFine',[
            'carObj' => $carObj,
            'contractObj' => $contractObj,
            'dateTime' => $inputData['date'],
            'eventObj' => $this->eventObj
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
        $eventFineObj=$eventFineRep->getEventFine($id);

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
        //
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
