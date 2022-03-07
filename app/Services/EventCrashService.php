<?php
namespace App\Services;


use App\Repositories\Interfaces\EventCrashRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;

Class EventCrashService{
    private $eventCrashRep,$timeSheetRep,$toPaymentRep;

    function __construct(EventCrashRepositoryInterface $eventCrashRep,TimeSheetRepositoryInterface $timeSheetRep,ToPaymentRepository $toPaymentRep)
    {
        $this->eventCrashRep=$eventCrashRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
    }


    public function addEvent($dataArray)
    {
        $dateTime=$dataArray['dateCrash'].' '.$dataArray['timeCrash'];

        $eventCrashData['contractId']=$dataArray['contractId'];
        $eventCrashData['sum']=$dataArray['sum'];
        $eventCrashData['culprit']=$dataArray['culprit'];
        $eventCrashData['comment']=$dataArray['comment'];
        $eventCrashObj=$this->eventCrashRep->addEventCrash($eventCrashData);

        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['contractId']=$dataArray['contractId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventCrashObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'] ?? 1;
        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
        if ($dataArray['isToPay']){
            $toPaymentArray['sum']=$dataArray['sum'] ??0;
            $toPaymentArray['timeSheetId']=$timeSheetObj->id;
            $toPaymentArray['contractId']=$dataArray['contractId'];
            $this->toPaymentRep->addToPayment($toPaymentArray);
        }

    }

    public function getEvents($periodDate,$eventId)
    {
        $eventsObj=$this->eventCrashRep->getEventCrashes($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }



}
