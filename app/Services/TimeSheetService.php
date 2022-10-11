<?php
namespace App\Services;
use App\Models\carConfiguration;
use App\Models\rentContract;
use App\Models\timeSheet;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\RentEventRepository;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Requests\Filters;

Class TimeSheetService{
    private $timeSheetRep,$toPaymentRep,$motorPoolRep,$rentEventRep;

    function __construct(
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        MotorPoolRepositoryInterface $motorPoolRep,
        RentEventRepositoryInterface $rentEventRep
    ){
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->motorPoolRep = $motorPoolRep;
        $this->rentEventRep = $rentEventRep;
    }

    public function getCarsTimeSheets($periodDate,$accuracyH)
    {
        $accuracyMin = $accuracyH*60;
        $timeSheetsArray = $this->timeSheetRep->getTimeSheetsArray($periodDate);
        //$timeSheetsArray->dd();
        //$timeSheetsCollection = collect($timeSheetsArray);
        //$periodTimeSheet = $timeSheetsCollection->whereBetween('dateTime',[$periodDate->getStartDate()->format('Y-m-d'),$periodDate->getEndDate()->format('Y-m-d')])->sortBy('dateTime');
            foreach($timeSheetsArray as $dayTimeSheet){
                if ($dayTimeSheet->toPaymentPaymentSum){
                    $dayTimeSheet->eventColor = $dayTimeSheet->eventColorPartPay;
                }
                if ($dayTimeSheet->toPaymentSum == $dayTimeSheet->toPaymentPaymentSum) {
                    $dayTimeSheet->eventColor = $dayTimeSheet->eventColorPay;
                }
                $currentDateTime = Carbon::parse($dayTimeSheet->dateTime);

                $dayTimeSheet->carActual = false;

                $fromBox = ceil($periodDate->getStartDate()->DiffInMinutes($currentDateTime)/$accuracyMin);
                if ($fromBox == $periodDate->getStartDate()->DiffInMinutes($currentDateTime)/$accuracyMin){
                    $fromBox++;
                }
                $toBox = $fromBox+ceil($dayTimeSheet->duration/$accuracyMin);
                for($i = $fromBox;$i<$toBox;$i++){
                    $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['data'] = $dayTimeSheet;
                    if ($i == $fromBox){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['first'] = true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['first'] = false;
                    }
                    if ($i == $toBox-1){
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['last'] = true;
                    } else {
                        $resultArray[$dayTimeSheet->carId][$dayTimeSheet->eventPriority][$i]['last'] = false;
                    }
                }
            }

        return $resultArray ?? [];
    }


    public function getActualCarsByGroup(CarbonPeriod $periodDate,$carGroupId)
    {
        $motorPoolsObj = $this->motorPoolRep->getCarsByGroup($carGroupId);

        $gapStart = $periodDate->getStartDate();
        $gapFinish = $periodDate->getEndDate();
        foreach($motorPoolsObj as $key => $motorPoolObj){
            if (is_null($motorPoolObj->dateFinish)){
                $motorPoolObj->dateFinish = Carbon::parse('9999-12-30');
            }
            if ($motorPoolObj->dateStart->gt($gapFinish)|| $motorPoolObj->dateFinish->lt($gapStart)){
                unset($motorPoolsObj[$key]);
            }

        }

        return $motorPoolsObj;
    }




    public function addTimeSheet()
    {

    }

    public function getCarTimeSheets(carConfiguration $carObj,CarbonPeriod $date,ContractRepositoryInterface $contractRep)
    {
        //$result = $this->timeSheetRep->getCarTimeSheetByDate($carObj->id,$date);
        $result = $this->timeSheetRep->getCarFullInfoByDay($carObj->id,$date);

        $result->each(function ($item, $key) use (&$contractRep) {

                if ($item->toPaymentPaymentSum){
                    $item->eventColor = $item->eventColorPartPay;
                }
                if ($item->toPaymentSum == $item->toPaymentPaymentSum) {
                    $item->eventColor = $item->eventColorPay;
                }

            $contractObj = $contractRep->getContract($item->contractId);
            $item->contract= $contractObj;


        });

        return $result;
    }

    public function getDaysTimeSheet(CarbonPeriod $datePeriod)
    {

    }


    public function getAllTimeSheets(CarbonPeriod $datePeriod,Filters\EventListRequest $eventListRequest=null)
    {

        $result = $this->timeSheetRep->getTimeSheetsArray($datePeriod,$eventListRequest);
        return $result;
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


    public function getLastRecord($eventId,$carId,ContractRepositoryInterface $contractRep)
    {
        $eventObj = $this->rentEventRep->getEvent($eventId);
        $carObj = $this->motorPoolRep->getCar($carId);
        $lastTimeSheetObj = $this->timeSheetRep->getLastTimeSheet($carObj,$eventObj);

        $toPaymentObj = $this->toPaymentRep->getToPaymentByTimeSheet($lastTimeSheetObj->id);

        $contractObj = $contractRep->getContract($toPaymentObj->contractId);

        if ($lastTimeSheetObj->dateTime){
            $dateTimeBegin = $lastTimeSheetObj->dateTime->format('Y-m-d H:i');
            $dateTimeEnd = $lastTimeSheetObj->dateTime->addMinute($lastTimeSheetObj->duration)->format('Y-m-d H:i');
        } else {
            $dateTimeBegin = null;
            $dateTimeEnd = null;
        }
//        $toPaymentModel = $lastTimeSheetObj->toPayment();
//        $toPaymentModel->dd();
        //$contractModel = $toPaymentModel->contract();
        $collectInfo = collect([
            'carId' => $carObj->id,
            'timeSheetId' => $lastTimeSheetObj->id,
            'carNickName' => $carObj->nickName,
            'eventName' => $eventObj->name,
            'dateTimeBegin' => $dateTimeBegin,
            'dateTimeEnd' => $dateTimeEnd,
            'contractNumber' => $contractObj->number,
            'contractId' => $contractObj->id,
            'contractPrice' => $contractObj->price,

        ]);
        return $collectInfo;
    }



}
