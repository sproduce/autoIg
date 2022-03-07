<?php
namespace App\Services;


use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventRentalService{
    private $eventRentalRep,$timeSheetRep,$toPaymentRep;

    function __construct(EventRentalRepositoryInterface $eventRentalRep,TimeSheetRepositoryInterface $timeSheetRep,ToPaymentRepository $toPaymentRep)
    {
        $this->eventRentalRep=$eventRentalRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
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

        $timesheetData['contractId']=$dataArray['contractId'];
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

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj=$this->eventRentalRep->getEventRentals($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        //$eventsObj->dd();
        //$eventsObj=$this->timeSheetRep->getTimeSheetsByEvent($eventId,$periodDate);
        return $eventsObj;
    }


}
