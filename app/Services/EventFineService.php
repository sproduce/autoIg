<?php
namespace App\Services;


use App\Repositories\Interfaces\EventFineRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

Class EventFineService{
    private $eventFineRep,$timeSheetRep;

    function __construct(EventFineRepositoryInterface $eventFineRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventFineRep=$eventFineRep;
        $this->timeSheetRep=$timeSheetRep;
    }


    public function addEvent($dataArray)
    {
        $eventFineData['contractId']=$dataArray['contractId'];
        $eventFineData['dateTimeOrder']=$dataArray['dateOrder'];
        $eventFineData['uin']=$dataArray['uin'];
        $eventFineData['datePaySale']=$dataArray['datePaySale'];
        $eventFineData['datePayMax']=$dataArray['datePayMax'];
        $eventFineData['sum']=$dataArray['sum'];
        $eventFineData['sumSale']=$dataArray['sumSale'];
        $eventFineData['dateTimeFine']=$dataArray['dateTimeFine'];

        $eventFineObj=$this->eventFineRep->addEventFine($eventFineData);
        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventFineObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'] ?? 1;
        $timesheetData['dateTime']=date("Y-m-d H:i:s",strtotime($dataArray['dateTimeFine']));

        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);


    }





}
