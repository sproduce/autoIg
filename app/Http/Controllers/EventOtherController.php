<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Models\rentEventOther;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\MotorPoolService;
use Illuminate\Http\Request;

class EventOtherController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CarIdDate $carIdDate,MotorPoolService $motorPoolServ,ContractRepositoryInterface $contractRep)
    {
        $inputData = $carIdDate->validated();
        $carObj = $motorPoolServ->getCar($inputData['carId']);

        return response()->view('rentEvent.addEventOther',['carObj' => $carObj,
            'dateTime'=> $inputData['date'],
            'eventObj'=>$this->eventObj,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
