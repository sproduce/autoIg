<?php
namespace App\Services;
use App\Models\carConfiguration;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class TimeSheetService{
    private $timeSheetRep,$toPaymentRep;

    function __construct(TimeSheetRepositoryInterface $timeSheetRep,ToPaymentRepository $toPaymentRep)
    {
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
    }

    public function getCarsTimeSheets($periodDate,$accuracyH)
    {
        $accuracyMin=$accuracyH*60;
        $timeSheetsArray = $this->timeSheetRep->getTimeSheetsArray($periodDate);
        $timeSheetsCollection=collect($timeSheetsArray);
        $periodTimeSheet=$timeSheetsCollection->whereBetween('dateTime',[$periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d')])->sortBy('dateTime');
            foreach($periodTimeSheet as $dayTimeSheet){
                $currentDateTime=Carbon::parse($dayTimeSheet->dateTime);
                $fromBox=ceil($periodDate->getStartDate()->DiffInMinutes($currentDateTime)/$accuracyMin);
                if ($fromBox==$periodDate->getStartDate()->DiffInMinutes($currentDateTime)/$accuracyMin){
                    $fromBox++;
                }
                $toBox=$fromBox+ceil($dayTimeSheet->duration/$accuracyMin);
                for($i=$fromBox;$i<$toBox;$i++){
                    $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['data']=$dayTimeSheet;
                    if ($i==$fromBox){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['first']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['first']=false;
                    }
                    if ($i==$toBox-1){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['last']=true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['last']=false;
                    }
                }
            }
        return $resultArray ?? [];
    }


    public function addTimeSheet()
    {

    }

    public function getCarTimeSheets(carConfiguration $carObj,CarbonPeriod $date)
    {
        $result = $this->timeSheetRep->getCarTimeSheetByDate($carObj->id,$date);
        return $result;
    }

    public function getDaysTimeSheet(CarbonPeriod $datePeriod)
    {

    }


    public function getAllTimeSheets(CarbonPeriod $datePeriod)
    {
        return $this->timeSheetRep->getTimeSheetsArray($datePeriod);
    }

    public function getContractTimeSheets($contractId)
    {
        return $this->timeSheetRep->getContractTimeSheets($contractId);
    }


    public function getTimeSheetInfo($timeSheetId)
    {
        return $this->timeSheetRep->getTimeSheet($timeSheetId);
    }



    public function getCarSpanTimeSheets($carObj,$datePeriod)
    {
        return $this->timeSheetRep->getCarSpanTimeSheet($carObj->id,$datePeriod);
    }

    public function updateTimeSheet($timeSheetArray)
    {
        $timeSheetId=$timeSheetArray['timeSheetId'];
        $dateTime=$timeSheetArray['date'].' '.$timeSheetArray['time'];
        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
        $timesheetData['duration']=$timeSheetArray['duration'];
        $timesheetData['sum']=$timeSheetArray['sum'];
        $timesheetData['mileage']=$timeSheetArray['mileage'];
        $this->timeSheetRep->updateTimeSheet($timeSheetId,$timesheetData);
    }


    public function addTimeSheetContract($timeSheetId,$contractId)
    {
        $timeSheetObj=$this->timeSheetRep->getTimeSheet($timeSheetId);

    }

}
