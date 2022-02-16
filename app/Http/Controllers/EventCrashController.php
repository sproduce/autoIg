<?php

namespace App\Http\Controllers;

use App\Repositories\RentEventRepository;
use App\Services\EventCrashService;
use App\Services\MotorPoolService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventCrashController extends Controller
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
    public function create(MotorPoolService $motorPoolServ)
    {
        $inputData=$this->request->validate([
            'carId'=>'',
            'date'=>'']);

        if ($inputData['date']){
            $dateTime=new Carbon($inputData['date']);
        } else{
            $dateTime =new Carbon();
        }
        $dateTime->setTimeFrom(Carbon::now());

        $carObj=$motorPoolServ->getCar($inputData['carId']);
        return view('rentEvent.addEventCrash',['carObj'=>$carObj,'dateTime'=>$dateTime,'eventObj'=>$this->eventObj]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCrashService $eventCrashServ)
    {
        $inputData=$this->request->validate([
            'carId'=>'integer|required',
            'contractId'=>'',
            'dateCrash'=>'required',
            'timeCrash'=>'required',
            'culprit'=>'',
            'sum'=>'',
            'comment'=>'',
            'mileage'=>''
            ]);

        $inputData['eventId']= $this->eventObj->id;
        $inputData['color']=$this->eventObj->color;
        $inputData['duration']=$this->eventObj->duration;
        $eventCrashServ->addEvent($inputData);

        //return redirect('/timesheet/list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
