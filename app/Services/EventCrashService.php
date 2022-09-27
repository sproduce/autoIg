<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\EventCrashRepository;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Http\Requests\Event;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

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
      $resultEvents = $this->eventCrashRep->getEventCrashes($this->eventObj->id,$datePeriod);
      return $resultEvents;
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
        return $this->eventCrashRep->getEventCrash($dataId);
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
        $eventCrashRequest = app()->make(Event\CrashRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {
            $eventCrashModel = $this->eventCrashRep->getEventCrash($eventCrashRequest->get('id'));
            $eventCrashModel->culprit = $eventCrashRequest->get('culprit');
            $eventCrashModel = $this->eventCrashRep->addEventCrash($eventCrashModel);


            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventCrashModel->id);
            $timeSheetModel->carId =  $eventCrashRequest->get('carId');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId =  $eventCrashModel->id;
            $timeSheetModel->dateTime = $eventCrashRequest->get('dateTime');
            $timeSheetModel->mileage = $eventCrashRequest->get('mileage');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);


            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

            $toPaymentModel->payUp =  $timeSheetModel->dateTime->addMinutes($timeSheetModel->duration);

            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventCrashRequest->get('sum');
            $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }




        exit();
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
