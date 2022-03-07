<?php
namespace App\Services;


use App\Repositories\Interfaces\EventTransferRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\ToPaymentRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventTransferService{
    private $eventTransferRep,$timeSheetRep,$toPaymentRep;

    function __construct(EventTransferRepositoryInterface $eventTransferRep,TimeSheetRepositoryInterface $timeSheetRep,ToPaymentRepository $toPaymentRep)
    {
        $this->eventTransferRep=$eventTransferRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->toPaymentRep=$toPaymentRep;
    }


    public function addEvent($dataArray)
    {
        $eventTransferData['contractId']=$dataArray['contractId'];
        $eventTransferData['type']=$dataArray['typeTransfer'];
        $eventTransferObj=$this->eventTransferRep->addEventTransfer($eventTransferData);

        $timesheetData['carId']=$dataArray['carId'];
        $timesheetData['eventId']=$dataArray['eventId'];
        $timesheetData['comment']='';
        $timesheetData['contractId']=$dataArray['contractId'];
        $timesheetData['dataId']=$eventTransferObj->id;
        $timesheetData['color']=$dataArray['color'];
        $timesheetData['duration']=$dataArray['duration'] ?? 1;
        $dateTime=$dataArray['dateTransfer'].' '.$dataArray['timeTransfer'];
        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
        $timesheetData['mileage']=$dataArray['mileage'];
        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
    }


    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj=$this->eventTransferRep->getEventTransfers($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }


}
