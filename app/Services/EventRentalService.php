<?php
namespace App\Services;



use App\Models\carConfiguration;
use App\Models\rentEventRental;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;

use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventRentalService{
    private $eventRentalRep,$timeSheetRep,$toPaymentRep;

    function __construct(EventRentalRepositoryInterface $eventRentalRep,
                         TimeSheetRepositoryInterface $timeSheetRep,
                         ToPaymentRepository $toPaymentRep)
    {
        $this->eventRentalRep=$eventRentalRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
    }


    public function addEvent($dataArray)
    {
        $startDateText = $dataArray['dateStart'].' '.$dataArray['timeStart'];
        $finishDateText = $dataArray['dateFinish'].' '.$dataArray['timeFinish'];
        $startCarbon = new Carbon($startDateText);




        $diffMinutes = $startCarbon->diffInMinutes($finishDateText);
        $colIteration = floor($diffMinutes/$dataArray['duration']);
        $deltaMinutes = $diffMinutes-$colIteration*$dataArray['duration'];

        $timeSheetObj = new timeSheet();
        $timeSheetObj->carId = $dataArray['carId'];
        $timeSheetObj->eventId = $dataArray['eventId'];
        $timeSheetObj->comment = '';
        $timeSheetObj->color =  $dataArray['color'];
        $timeSheetObj->duration = $dataArray['duration'];

        $toPaymentObj = new toPayment();
        $toPaymentObj->contractId = $dataArray['contractId'];

        for ($i = 0; $i < $colIteration; $i++)
        {
            $rentEventObj = new rentEventRental();
            $rentEventObj = $this->eventRentalRep->addEventRental($rentEventObj);

            $timeSheetRep = $timeSheetObj->replicate();
            $timeSheetRep->dateTime = $startCarbon->toDateTimeString();
            $startCarbon->addDays(1);
            $timeSheetRep->dataId = $rentEventObj->id;
            $timeSheetRep = $this->timeSheetRep->addTimeSheet($timeSheetRep);

            $toPaymentRep = $toPaymentObj->replicate();
            $toPaymentRep->sum = $dataArray['sum'][$i]??0;
            $toPaymentRep->timeSheetId =  $timeSheetRep->id;
            $toPaymentRep = $this->toPaymentRep->addToPayment($toPaymentRep);
        }
        if ($deltaMinutes){
            $timeSheetRep = $timeSheetObj->replicate();
            $toPaymentRep = $toPaymentObj->replicate();

            $timeSheetRep->dateTime = $startCarbon->toDateTimeString();
            $timeSheetRep->sum = $dataArray['sum'][$colIteration]??0;
            $timeSheetRep->duration =$deltaMinutes;
            $timeSheetRep = $this->timeSheetRep->addTimeSheet($timeSheetRep);

            $toPaymentRep->sum = $dataArray['sum'][$i]??0;;
            $toPaymentRep->timeSheetId = $timeSheetObj->id;
            $toPaymentRep = $this->toPaymentRep->addToPayment($toPaymentRep);
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

    public function getEventRentalInfo($eventId,$eventRentalId)
    {
        $eventRentalObj = $this->eventRentalRep->getEventRentalFullInfo($eventId,$eventRentalId);
        //$eventRentalObj->dump();
        //var_dump($eventRentalObj);
        return $eventRentalObj;
    }



}
