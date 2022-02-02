<?php
namespace App\Services;


use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

use Carbon\Carbon;

Class EventRentalService{
    private $eventRentalRep,$timeSheetRep;

    function __construct(EventRentalRepositoryInterface $eventRentalRep,TimeSheetRepositoryInterface $timeSheetRep)
    {
        $this->eventRentalRep=$eventRentalRep;
        $this->timeSheetRep=$timeSheetRep;
    }


    public function addEvent($dataArray)
    {
        $startDateText=$dataArray['dateStart'].' '.$dataArray['timeStart'];
        $finishDateText=$dataArray['dateFinish'].' '.$dataArray['timeFinish'];
        $startCarbon=new Carbon($startDateText);
        $diffMinutes=$startCarbon->diffInMinutes($finishDateText);
        $colIteration=floor($diffMinutes/$dataArray['duration']);
        $deltaMinutes=$diffMinutes-$colIteration*$dataArray['duration'];

        $eventRentalData['contractId']=$dataArray['contractId'];
        $eventRentalObj=$this->eventRentalRep->addEventRental($eventRentalData);

        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventRentalObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'];

        for($i=0;$i<$colIteration;$i++)
        {
            $timesheetData['dateTime']=$startCarbon->toDateTimeString();
            $timesheetData['sum']=$dataArray['sum'][$i]??0;
            $startCarbon->addDays(1);
            $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
        }
        if ($deltaMinutes){
            $timesheetData['dateTime']=$startCarbon->toDateTimeString();
            $timesheetData['sum']=$dataArray['sum'][$colIteration]??0;
            $timesheetData['duration']=$deltaMinutes;
            $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
        }



    }

}
