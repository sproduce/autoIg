<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\EventCrashRepository;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventCrashService implements EventServiceInterface {
    private $eventCrashRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventCrashRep = new EventCrashRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->contractRep = $contractRep;
        $this->eventObj = $eventObj;
    }


    public function index(CarbonPeriod $datePeriod)
    {
      // TODO: Implement index() method.
    }

    public function destroy($dataId)
    {
    // TODO: Implement destroy() method.
    }

    public function getAdditionalViewDataArray()
    {
        // TODO: Implement getAdditionalViewDataArray() method.
    }

    public function getEventInfo($dataId = null)
    {
        // TODO: Implement getEventInfo() method.
    }

    public function getEventModel($modelId = null)
    {
        // TODO: Implement getEventModel() method.
    }
    public function getViews()
    {
        // TODO: Implement getViews() method.
    }
    public function store()
    {
        // TODO: Implement store() method.
    }



//
//    public function addEvent($dataArray)
//    {
//        $dateTime=$dataArray['dateCrash'].' '.$dataArray['timeCrash'];
//
//        $eventCrashData['contractId']=$dataArray['contractId'];
//        $eventCrashData['sum']=$dataArray['sum'];
//        $eventCrashData['culprit']=$dataArray['culprit'];
//        $eventCrashData['comment']=$dataArray['comment'];
//        $eventCrashObj=$this->eventCrashRep->addEventCrash($eventCrashData);
//
//        $timesheetData['carId']=$dataArray['carId'];
//        $timesheetData['eventId']=$dataArray['eventId'];
//        $timesheetData['contractId']=$dataArray['contractId'];
//        $timesheetData['comment']='';
//        $timesheetData['dataId']=$eventCrashObj->id;
//        $timesheetData['color']=$dataArray['color'];
//        $timesheetData['duration']=$dataArray['duration'] ?? 1;
//        $timesheetData['dateTime']=date("Y-m-d H:i:00",strtotime($dateTime));
//        $timeSheetObj=$this->timeSheetRep->addTimeSheet($timesheetData);
//        if ($dataArray['isToPay']){
//            $toPaymentArray['sum']=$dataArray['sum'] ??0;
//            $toPaymentArray['timeSheetId']=$timeSheetObj->id;
//            $toPaymentArray['contractId']=$dataArray['contractId'];
//            $this->toPaymentRep->addToPayment($toPaymentArray);
//        }
//
//    }
//
//    public function getEvents($periodDate,$eventId)
//    {
//        $eventsObj=$this->eventCrashRep->getEventCrashes($eventId,$periodDate);
//        $eventsObj->each(function ($item, $key) {
//            $item->dateTime=Carbon::parse($item->dateTime);
//        });
//        return $eventsObj;
//    }



}
