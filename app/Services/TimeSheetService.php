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
        //var_dump($motorPoolsObj->toArray());
        foreach($motorPoolsObj as $carId=>$motorPool){
            foreach($periodDate as $date){
                $fromDate=$date->format('Y-m-d');
                $toDate=$date->addDays(1)->format('Y-m-d');
                $dayTimeSheet=$timeSheetsObj->where('carId',$carId)->whereBetween('dateTime',[$fromDate,$toDate]);
                //$dayTimeSheet->dump();
            }

        }

        $timeSheetCollect=collect(['motorPools'=>$motorPoolsObj,'timeSheets'=>$timeSheetsObj]);

        return $timeSheetCollect;
    }

    public function getCarTimeSheets($carId,$date)
    {
             $result=$this->timeSheetRep->getCarTimeSheetByDate($carId,$date);
        return $result;
    }


    public function addEvent()
    {


    }




}
