<?php
namespace App\Services;


use App\Repositories\Interfaces\EventTransferRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

Class EventTransferService{
    private $eventTransferRep,$timeSheetRep;

    function __construct(EventTransferRepositoryInterface $eventTransferRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventTransferRep=$eventTransferRep;
        $this->timeSheetRep=$timeSheetRep;
    }


    public function addEvent($dataArray)
    {
        $eventTransferData['contractId']=$dataArray['contractId'];
        $eventTransferData['type']=$dataArray['typeTransfer'];
        $eventTransferObj=$this->eventTransferRep->addEventTransfer($eventTransferData);

        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventTransferObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'] ?? 1;

        $timesheetData['dateTime']=date("Y-m-d H:i:s",strtotime($dataArray['dateTimeTransfer']));
        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
    }





}
