<?php
namespace App\Services;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\RentEventRepository;
use Carbon\Carbon;

Class TimeSheetService{
    private $timeSheetRep,$motorPoolRep,$rentEvent;

    function __construct(TimeSheetRepositoryInterface $timeSheetRep,MotorPoolRepositoryInterface $motoPoolRep,RentEventRepository $rentEvent)
    {
        $this->timeSheetRep=$timeSheetRep;
        $this->motorPoolRep=$motoPoolRep;
        $this->rentEvent=$rentEvent;
    }

    public function getCarsTimeSheets($periodDate)
    {

        //$timeSheetsObj=$this->timeSheetRep->getTimeSheets($periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d'));
        $timeSheetsArray=$this->timeSheetRep->getTimeSheetsArray($periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d'));

        $timeSheetsCollection=collect($timeSheetsArray);
        //$timeSheetsCollection->sortBy('carId')->dd();
        //var_dump($timeSheetsArray);
        //$motorPoolsObj=$this->motorPoolRep->getCars()->keyBy('id');
        //var_dump($motorPoolsObj->toArray());

            $periodTimeSheet=$timeSheetsCollection->whereBetween('dateTime',[$periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d')])->sortBy('dateTime');
        //$periodTimeSheet->dd();
            foreach($periodTimeSheet as $dayTimeSheet){
                //echo $periodDate->getStartDate()->format('Y-m-d H:m');
                $currentDateTime=Carbon::parse($dayTimeSheet->dateTime);
                $fromBox=ceil($periodDate->getStartDate()->DiffInMinutes($currentDateTime)/240);
                if ($fromBox==$periodDate->getStartDate()->DiffInMinutes($currentDateTime)/240){
                    $fromBox++;
                }
                //$fromBox=$fromBox ??1;
                $toBox=$fromBox+ceil($dayTimeSheet->duration/240);
                for($i=$fromBox;$i<=$toBox;$i++){
                    $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['data']=$dayTimeSheet;
                    if ($i==$fromBox){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['first']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['first']=false;
                    }
                    if ($i==$toBox){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['last']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]['last']=false;
                    }

                    //$resultArray[$dayTimeSheet->carId][$dayTimeSheet->priority][$i]->comment=$periodDate->getStartDate()->diffInHours($currentDateTime);
                }
                //echo $fromBox." - ".$toBox;
                //var_dump($dayTimeSheet);
            }

            //var_dump($resultArray);

        //$timeSheetCollect=collect(['motorPools'=>$motorPoolsObj,'timeSheets'=>$timeSheetsObj]);

        //return $timeSheetCollect;
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
