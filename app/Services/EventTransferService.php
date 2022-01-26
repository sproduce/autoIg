<?php
namespace App\Services;


use App\Repositories\Interfaces\EventTransferRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

Class EventTransferService{
    private $eventTransferRep,$timeSheetRep;

    function __construct(EventTransferRepositoryInterface $eventRentalRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventTransferRep=$eventRentalRep;
        $this->timeSheetRep=$timeSheetRep;
    }


    public function addEvent($dataArray)
    {
        $eventRentalData['contractId']=$dataArray['contractId'];
        $eventRentalObj=$this->eventRentalRep->addEventRental($eventRentalData);
        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventRentalObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'];

        foreach($dataArray['dateTimeSheet'] as $key=>$dateTime){
            $timesheetData['dateTime']=date("Y-m-d H:i:s",strtotime($dateTime));
            $timesheetData['sum']=$dataArray['sum'][$key];
            $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
            //$timeSheetObj->dd();
        }

    }





}
