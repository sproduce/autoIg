<?php
namespace App\Services;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\RentEventRepository;
use Carbon\Carbon;

Class TimeSheetService{
    private $timeSheetRep;

    function __construct(TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->timeSheetRep=$timeSheetRep;
    }

    public function getCarsTimeSheets($periodDate)
    {
        $timeSheetsArray=$this->timeSheetRep->getTimeSheetsArray($periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d'));
        $timeSheetsCollection=collect($timeSheetsArray);
        $periodTimeSheet=$timeSheetsCollection->whereBetween('dateTime',[$periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d')])->sortBy('dateTime');
            foreach($periodTimeSheet as $dayTimeSheet){
                $currentDateTime=Carbon::parse($dayTimeSheet->dateTime);
                $fromBox=ceil($periodDate->getStartDate()->DiffInMinutes($currentDateTime)/240);
                if ($fromBox==$periodDate->getStartDate()->DiffInMinutes($currentDateTime)/240){
                    $fromBox++;
                }
                $toBox=$fromBox+ceil($dayTimeSheet->duration/240);
                for($i=$fromBox;$i<$toBox;$i++){
                    $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['data']=$dayTimeSheet;
                    if ($i==$fromBox){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['first']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['first']=false;
                    }
                    if ($i==$toBox-1){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['last']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['last']=false;
                    }
                }
            }
        return $resultArray ?? [];
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
