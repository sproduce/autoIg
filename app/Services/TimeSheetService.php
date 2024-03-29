<?php
namespace App\Services;
use App\Models\carConfiguration;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\timeSheet;

use Carbon\Carbon;
use Carbon\CarbonPeriod;


Class TimeSheetService{
    private $timeSheetRep, $toPaymentRep, $motorPoolRep, $rentEventRep, $rentEventService, $fileService, $contractRep;

    function __construct(
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        MotorPoolRepositoryInterface $motorPoolRep,
        RentEventRepositoryInterface $rentEventRep,
        RentEventService $rentEventService,
        PhotoService $photoServ,
        ContractRepositoryInterface $contractRep
            
    ){
        $this->contractRep = $contractRep;
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->motorPoolRep = $motorPoolRep;
        $this->rentEventRep = $rentEventRep;
        $this->rentEventService = $rentEventService;
         $this->fileService = $photoServ;
    }

    public function getCarsTimeSheets($periodDate,$accuracyH)
    {
        $accuracyMin = $accuracyH*60;
        $filterCollection = collect();
        $timeSheetsArray = $this->timeSheetRep->getTimeSheetsArray($filterCollection,$periodDate);
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


    
    
    public function getCarTimeSheetsModel(carConfiguration $carObj)
    {
        return $this->timeSheetRep->getCarTimeSheets($carObj->id);
    }
    
    
    public function getCarEvents($carId,$eventId) 
    {
        $eventObj = $this->rentEventRep->getEvent($eventId);
        $eventServ = $this->rentEventService->getEventService($eventObj);
        $timeSheetsObj = $this->timeSheetRep->getCarTimeSheets($carId, $eventId);
        foreach ($timeSheetsObj as $timeSheetObj)
        {
            $timeSheetObj->eventModel = $eventServ->getEventModel($timeSheetObj->dataId);
        }
        return $timeSheetsObj;
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


    public function getAllTimeSheets(\Illuminate\Support\Collection $eventListRequest,CarbonPeriod $datePeriod = null)
    {
        $result = $this->timeSheetRep->getTimeSheetsArray($eventListRequest,$datePeriod);
        
        
        foreach ($result as $eventData){
            $eventObj =  $this->rentEventService->getRentEvent($eventData->eventId);
            //echo $eventData->uuid." <br/>";
            $eventData->files = $this->fileService->getFiles($eventData->uuid);
            $eventServiceObj = $this->rentEventService->getEventService($eventObj);
            $eventFullInfo = $eventServiceObj->getEventInfo($eventData->dataId);
            if ($eventData->toPaymentPaymentSum){
                $eventData->color = $eventObj->colorPartPay;
            }
            if ($eventData->toPaymentPaymentSum == $eventData->toPaymentSum){
                $eventData->color = $eventObj->colorPay;
            }
            
            $eventData->eventFullInfo = $eventFullInfo;
            $eventData->contractFullInfo = $this->contractRep->getContract($eventFullInfo->contractId);
            $eventData->eventObj = $eventObj;
            $eventData->timeSheetObj = $this->timeSheetRep->getTimeSheet($eventData->id);
            //var_dump($eventData);
        }
        
        
        
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
        $timeSheetId = $timeSheetArray['timeSheetId'];
        $dateTime = $timeSheetArray['date'].' '.$timeSheetArray['time'];
        $timesheetData['dateTime'] = date("Y-m-d H:i:00",strtotime($dateTime));
        $timesheetData['duration'] = $timeSheetArray['duration'];
        $timesheetData['sum'] = $timeSheetArray['sum'];
        $timesheetData['mileage'] = $timeSheetArray['mileage'];
        $this->timeSheetRep->updateTimeSheet($timeSheetId,$timesheetData);
    }


    public function addTimeSheetContract($timeSheetId,$contractId)
    {
        $timeSheetObj = $this->timeSheetRep->getTimeSheet($timeSheetId);

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


    
    
    public function getLastTimeSheet($eventId,$carId)
    {//return eventModel
        $eventObj = $this->rentEventRep->getEvent($eventId);
        $carObj = $this->motorPoolRep->getCar($carId);
        $timeSheetObj = $this->timeSheetRep->getLastTimeSheet($carObj, $eventObj);
        
        $eventServ = $this->rentEventService->getEventService($eventObj);
        
        return $eventServ->getEventInfo($timeSheetObj->dataId);
    }

    public function getLastTimeSheetModel($eventId,$carId)
    {//return eventModel
        $eventObj = $this->rentEventRep->getEvent($eventId);
        $carObj = $this->motorPoolRep->getCar($carId);
        $timeSheetObj = $this->timeSheetRep->getLastTimeSheet($carObj, $eventObj);
        
        $eventServ = $this->rentEventService->getEventService($eventObj);
        
        return $eventServ->getEventModel($timeSheetObj->dataId);
    }
    
    
    public function getTimeSheetsObjByPeriod(CarbonPeriod $periodDate) 
    {
        $timeSheets = $this->timeSheetRep->getTimeSheetsPeriod($periodDate);
        
        foreach ($timeSheets as $timeSheet){
            $eventServ = $this->rentEventService->getEventService($timeSheet->event);
            $timeSheet->dataEvent = $eventServ->getEventModel($timeSheet->dataId);
        }
        
        
        return  $timeSheets;
    }
    
    
    public function getTimeSheetsObjByCar(CarbonPeriod $periodDate, carConfiguration $motorPool)
    {
        exit();
    }
    
    
    public function getTimeSheetByEvent(\App\Models\rentEvent $eventObj, $dataId)
    {
        $timeSheetObj = $this->timeSheetRep->getTimeSheetByEvent($eventObj, $dataId);
        $eventServ = $this->rentEventService->getEventService($eventObj);
        $timeSheetObj->dataEvent = $eventServ->getEventModel($dataId);
        return $timeSheetObj;
    }
    
    
    
    
}
