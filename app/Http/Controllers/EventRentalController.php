<?php

namespace App\Http\Controllers;

use App\Repositories\RentEventRepository;
use App\Services\EventRentalService;
use App\Services\MotorPoolService;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MotorPoolService $motorPoolServ)
    {
        $inputData=$this->request->validate(['carId'=>'integer','date'=>'']);
        if (isset($inputData['date'])){
            $dateTime=new Carbon($inputData['date']);
        } else{
            $dateTime =new Carbon();
        }
        $dateTime->setTimeFrom(Carbon::now());
        $carObj=$motorPoolServ->getCar($inputData['carId']);

        return view('rentEvent.addEventRental',['carObj'=>$carObj,'dateTime'=>$dateTime,'eventObj'=>$this->eventObj]);
    }


    public function store(EventRentalService $eventRentalServ)
    {
        $inputData=$this->request->validate(['carId'=>'integer|required',
                                             'dateTimeSheet'=>'array|min:1',
                                             'sum'=>'array',
                                             'duration'=>'',
                                             'contractId'=>'']);
        $inputData['eventId']= $this->eventObj->id;
        $inputData['color']=$this->eventObj->color;
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
