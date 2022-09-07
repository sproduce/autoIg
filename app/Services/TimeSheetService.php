<?php
namespace App\Services;
use App\Models\carConfiguration;
use App\Models\timeSheet;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class TimeSheetService{
    private $timeSheetRep,$toPaymentRep,$motoPoolRep,$rentEventRep;

    function __construct(
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        MotorPoolRepositoryInterface $motorPoolRep,
        RentEventRepositoryInterface $rentEventRep
    ){
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->motoPoolRep = $motorPoolRep;
        $this->rentEventRep = $rentEventRep;
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
        //$result = $this->timeSheetRep->getCarTimeSheetByDate($carObj->id,$date);
        $result = $this->timeSheetRep->getCarFullInfoByDay($carObj->id,$date);

        $result->each(function ($item, $key) {
            if ($item->toPaymentPaymentSum) {
                if ($item->toPaymentSum == $item->toPaymentPaymentSum) {
                    $item->eventColor = $item->eventColorPay;
                } else {
                    $item->eventColor = $item->eventColorPartPay;
                }
            }
        });


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
        $timesheetData['dateTime'] = date("Y-m-d H:i:00",strtotime($dateTime));
        $timesheetData['duration'] = $timeSheetArray['duration'];
        $timesheetData['sum'] = $timeSheetArray['sum'];
        $timesheetData['mileage'] = $timeSheetArray['mileage'];
        $this->timeSheetRep->updateTimeSheet($timeSheetId,$timesheetData);
    }


    public function addTimeSheetContract($timeSheetId,$contractId)
    {
        $timeSheetObj=$this->timeSheetRep->getTimeSheet($timeSheetId);

    }


    public function getLastRecord($eventId,$carId)
    {
        $eventObj = $this->rentEventRep->getEvent($eventId);
        $carObj = $this->motoPoolRep->getCar($carId);
        $lastTimeSheetObj = $this->timeSheetRep->getLastTimeSheet($carObj,$eventObj);
        $contractObj = $lastTimeSheetObj->toPayment()->first()->contract()->first();
        if ($lastTimeSheetObj->dateTime){
            $dateTimeEnd = $lastTimeSheetObj->dateTime->addMinute($lastTimeSheetObj->duration)->format('Y-m-d H:i');
        } else {
            $dateTimeEnd = '';
        }
//        $toPaymentModel = $lastTimeSheetObj->toPayment();
//        $toPaymentModel->dd();
        //$contractModel = $toPaymentModel->contract();
        $collectInfo = collect([
            'carId' => $carObj->id,
            'timeSheetId' => $lastTimeSheetObj->id,
            'carNickName' => $carObj->nickName,
            'dateTimeEnd' => $dateTimeEnd,
            'contractNumber' => $contractObj->number,
            'contractId' => $contractObj->id,
            'contractPrice' => $contractObj->price,

        ]);
        return $collectInfo;
    }



}
