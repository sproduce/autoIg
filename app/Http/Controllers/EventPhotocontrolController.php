<?php

namespace App\Http\Controllers;

use App\Repositories\RentEventRepository;
use App\Services\MotorPoolService;
use App\Services\PhotoService;
use Carbon\Carbon;
use Illuminate\Http\Request;


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
            'date'=>'required']);

        if ($inputData['date']){
            $dateTime=new Carbon($inputData['date']);
        } else{
            $dateTime =new Carbon();
        }
        $dateTime->setTimeFrom(Carbon::now());

        $carObj=$motorPoolServ->getCar($inputData['carId']);
        return view('rentEvent.addEventPhotocontrol',['carObj'=>$carObj,'dateTime'=>$dateTime,'eventObj'=>$this->eventObj]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoService $photoServ)
    {
        $file=$this->request->file('photo');
        //$path = $file[1]->storeAs('photo/12/12','test');
        $photoServ->savePhoto($file,'uuid');
        //$file[0]->
        //echo $file[1]->hashName();
        //echo sha1($file[1]->get());
        //var_dump($path);
        //var_dump($this->request->validate(['photo'=>'']));
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
