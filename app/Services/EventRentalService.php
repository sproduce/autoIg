<?php
namespace App\Services;


use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

Class EventRentalService{
    private $eventRentalRep,$timeSheetRep;

    function __construct(EventRentalRepositoryInterface $eventRentalRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventRentalRep=$eventRentalRep;
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
            $this->timeSheetRep->addTimeSheet($timesheetData);
        }



    }





}
