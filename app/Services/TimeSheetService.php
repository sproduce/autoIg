<?php
namespace App\Services;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

Class TimeSheetService{
    private $timeSheetRep,$request,$motorPoolRep;

    function __construct(TimeSheetRepositoryInterface $timeSheetRep,MotorPoolRepositoryInterface $motoPoolRep,Request $request)
    {
        $this->timeSheetRep=$timeSheetRep;
        $this->request=$request;
        $this->motorPoolRep=$motoPoolRep;
    }

    public function getCarsTimeSheets($periodDate)
    {

        $timeSheetsObj=$this->timeSheetRep->getTimeSheets($periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d'));


        $motorPoolsObj=$this->motorPoolRep->getCars()->keyBy('id');

        $timeSheetCollect=collect(['motorPools'=>$motorPoolsObj,'timeSheets'=>$timeSheetsObj]);

        return $timeSheetCollect;
    }

    public function getCarTimeSheets()
    {
        $validate=$this->request->validate(['carId'=>'required|integer',
            'date'=>'required'
        ]);
        $result=$this->timeSheetRep->getCarTimeSheetByDate($validate['carId'],$validate['date']);
        return $result;
    }


    public function addEvent()
    {
        $validate=$this->request->validate(['carId'=>'required|integer',
            'dateTime'=>'required',
            'eventId'=>'required|integer',
            'comment'=>'',
            'sum'=>'',
            'mileage'=>''
        ]);

        $this->timeSheetRep->addTimeSheet($validate);

    }




}
