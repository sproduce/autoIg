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

    public function getCarsTimeSheets()
    {
        $dateFrom=Carbon::now()->subDays(7);
        $dateTo=Carbon::now()->addDay(8);
        $timeSheetsObj=$this->timeSheetRep->getTimeSheets($dateFrom->format('Y-m-d'),$dateTo->format('Y-m-d'));


        //$timeSheetsObj->dump();
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
            'sum'=>''
        ]);

        $this->timeSheetRep->addTimeSheet($validate);

    }




}
