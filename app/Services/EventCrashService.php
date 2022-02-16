<?php
namespace App\Services;


use App\Repositories\Interfaces\EventCrashRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

Class EventCrashService{
    private $eventCrashRep,$timeSheetRep;

    function __construct(EventCrashRepositoryInterface $eventCrashRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventCrashRep=$eventCrashRep;
        $this->timeSheetRep=$timeSheetRep;
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
        $this->timeSheetRep->addTimeSheet($timesheetData);

//        $eventFineObj=$this->eventFineRep->addEventFine($eventFineData);
//        $timesheetData['carId']=$dataArray['carId'];
//        $timesheetData['eventId']=$dataArray['eventId'];
//        $timesheetData['comment']='';
//        $timesheetData['dataId']=$eventFineObj->id;
//        $timesheetData['color']=$dataArray['color'];
//        $timesheetData['duration']=$dataArray['duration'] ?? 1;
//
//        $dateTime=$dataArray['dateFine'].' '.$dataArray['timeFine'];
//        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
//
//
//        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);


    }





}
