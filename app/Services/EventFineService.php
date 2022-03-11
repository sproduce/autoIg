<?php
namespace App\Services;


use App\Repositories\Interfaces\EventFineRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventFineService{
    private $eventFineRep,$timeSheetRep,$toPaymentRep;

    function __construct(EventFineRepositoryInterface $eventFineRep,
                         TimeSheetRepositoryInterface $timeSheetRep,
                         ToPaymentRepository $toPaymentRep)
    {
        $this->eventFineRep=$eventFineRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
    }


    public function addEvent($dataArray)
    {
        $dateTime=$dataArray['dateFine'].' '.$dataArray['timeFine'];
        $eventFineData['contractId']=$dataArray['contractId'];
        $eventFineData['dateTimeOrder']=$dataArray['dateOrder'];
        $eventFineData['uin']=$dataArray['uin'];
        $eventFineData['datePaySale']=$dataArray['datePaySale'];
        $eventFineData['datePayMax']=$dataArray['datePayMax'];
        $eventFineData['sum']=$dataArray['sum'];
        $eventFineData['sumSale']=$dataArray['sumSale'];
        $eventFineData['dateTimeFine']=date("Y-m-d H:i:00",strtotime($dateTime));//remove

        $eventFineObj=$this->eventFineRep->addEventFine($eventFineData);
        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['dataId']=$eventFineObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'] ?? 1;

        $dateTime=$dataArray['dateFine'].' '.$dataArray['timeFine'];
        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));


        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);

        if ($dataArray['isToPay']){
            $toPaymentArray['sum']=$dataArray['sum'] ??0;
            $toPaymentArray['timeSheetId']=$timeSheetObj->id;
            $toPaymentArray['contractId']=$dataArray['contractId'];
            $this->toPaymentRep->addToPayment($toPaymentArray);
        }
    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj=$this->eventFineRep->getEventFines($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }



}
