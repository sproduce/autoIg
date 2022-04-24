<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Models\rentEventOther;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\EventOtherService;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;
use App\Http\Requests\Event\OtherRequest;

class EventOtherController extends Controller
{
    protected $rentEventRep,$request,$eventObj;

    public function __construct(RentEventRepository $rentEventRep)
    {
        $this->rentEventRep = $rentEventRep;
        $rc= new \ReflectionClass($this);
        $eventObj=$rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj=$eventObj;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

       public function create(CarIdDate $carIdDate,MotorPoolService $motorPoolServ,ContractRepositoryInterface $contractRep)
    {
        $inputData = $carIdDate->validated();
        $carObj = $motorPoolServ->getCar($inputData['carId']);

        return view('rentEvent.addEventOther',['carObj' => $carObj,
            'dateTime'=> $inputData['date'],
            'eventObj'=>$this->eventObj,
        ]);
    }


    public function store(EventOtherService $otherServ,OtherRequest $otherForm)
    {
        $otherForm->validated();
        $otherServ->addEvent($otherForm,$this->eventObj,$this->eventObj);
        return redirect('/timesheet/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rentEventOther  $rentEventOther
     * @return \Illuminate\Http\Response
     */
    public function show(rentEventOther $rentEventOther)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rentEventOther  $rentEventOther
     * @return \Illuminate\Http\Response
     */
    public function edit(rentEventOther $rentEventOther)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rentEventOther  $rentEventOther
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rentEventOther $rentEventOther)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rentEventOther  $rentEventOther
     * @return \Illuminate\Http\Response
     */
    public function destroy(rentEventOther $rentEventOther)
    {
        //
    }
}
