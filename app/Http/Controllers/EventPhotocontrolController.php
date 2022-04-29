<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarIdDate;
use App\Http\Requests\DateSpan;
use App\Http\Requests\NeedParent;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Services\MotorPoolService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\EventPhotocontrolService;

class EventPhotocontrolController extends Controller
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
    public function index(DateSpan $dateSpan,EventPhotocontrolService $eventPhotocontrolServ)
    {
        $dateSpan->validated();
        $periodDate=$dateSpan->getCarbonPeriod();
        $eventsObj=$eventPhotocontrolServ->getEvents($periodDate,$this->eventObj->id);
        return response()->view('rentEvent.listEventsPhotocontrol',['eventsObj' => $eventsObj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(NeedParent $needParent,
                           CarIdDate $carIdDate,
                           MotorPoolService $motorPoolServ,
                           ContractRepositoryInterface $contractRep)
    {
        $inputData=$carIdDate->validated();
        $nP = $needParent->validated();
        $contractObj=$contractRep->getContract($inputData['contractId']);
        if ($contractObj->carId){
            $carObj=$motorPoolServ->getCar($contractObj->carId);
        } else{
            $carObj=$motorPoolServ->getCar($inputData['carId']);
        }
        return response()->view('rentEvent.addEventPhotocontrol',[
            'carObj' => $carObj,
            'needParent' => $nP['needParent'],
            'contractObj' => $contractObj,
            'dateTime'=>$inputData['date'],
            'eventObj'=>$this->eventObj,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventPhotocontrolService $eventPhotocontrolServ)
    {
        $file=$this->request->file('photo');
        $inputData=$this->request->validate([
            'carId'=>'integer|required',
            'datePhoto'=>'required',
            'timePhoto'=>'required',
            'mileage'=>'',
            'contractId'=>'',
            'comment'=>'']);
        $inputData['eventId']= $this->eventObj->id;
        $inputData['color']=$this->eventObj->color;
        $inputData['duration']=$this->eventObj->duration;
        $eventPhotocontrolServ->addEvent($file,$inputData);
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
