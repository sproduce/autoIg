<?php
namespace App\Services;


use App\Http\Requests\Event;
use App\Models\rentEvent;
use App\Repositories\EventFineRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventFineService implements EventServiceInterface {
    private $eventFineRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventFineRep = new EventFineRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->contractRep = $contractRep;
        $this->eventObj = $eventObj;
    }


    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventFineRep->getEventFines($this->eventObj->id,$datePeriod);
        return $resultEvents;
    }

   public function getEventModel($modelId = null)
   {
       return $this->eventFineRep->getEventFine($modelId);
   }

    public function getAdditionalViewDataArray()
    {
        return [];
    }

    public function getViews()
    {

    }


    public function store()
    {
        $eventFine = app()->make(Event\FineRequest::class);
        $timeSheetModel = $this->timeSheetRep->getTimeSheet(null);
    }


    public function getEventInfo($eventId)
    {
        // TODO: Implement getEventInfo() method.
    }


    public function addEvent(Event\FineRequest $fineRequest,rentEvent $eventObj)
    {

        if ($fineRequest->get('id')){
            $this->rentEventFineModel = $this->rentEventFineModel->find($fineRequest->get('id'));
            $this->timeSheetModel =  $this->timeSheetModel->where('eventId',$eventObj->id)->where('dataId',$fineRequest->get('id'))->first();
        }


        $this->rentEventFineModel->dateTimeOrder = $fineRequest->get('dateOrder');
        $this->rentEventFineModel->datePayMax = $fineRequest->get('datePayMax');
        $this->rentEventFineModel->datePaySale = $fineRequest->get('datePaySale');
        $this->rentEventFineModel->dateTimeFine = $fineRequest->get('dateTimeFine');
        $this->rentEventFineModel->sum = $fineRequest->get('sum');
        $this->rentEventFineModel->sumSale = $fineRequest->get('sumSale');
        $this->rentEventFineModel->save();

        $this->timeSheetModel->carId = $fineRequest->get('carId');
        $this->timeSheetModel->dataId = $this->rentEventFineModel->id;
        $this->timeSheetModel->eventId = $eventObj->id;
        $this->timeSheetModel->dateTime = $fineRequest->get('dateTimeFine');
        $this->timeSheetModel->duration = $eventObj->duration;
        $this->timeSheetModel->color = $eventObj->color;
        $this->timeSheetModel->save();

        if (!$fineRequest->get('id')){
            $this->toPaymentModel->sum = -1 * abs($fineRequest->get('sumSale'));
            $this->toPaymentModel->timeSheetId =  $this->timeSheetModel->id;
            $this->toPaymentModel->save();
        }

    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj = $this->eventFineRep->getEventFines($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }

    public function getEventFullInfo($eventId,rentEvent $eventObj,CarIdDate $carIdDate)
    {
        if ($eventId){

        }

        $eventFineFullInfo = collect([
            'eventObj' => $eventObj,
            'eventFineObj' => $this->rentEventFineModel,
            'toPayObj' => $this->toPaymentModel,
            'timeSheetObj' => $this->timeSheetModel,
        ]);

        return  $eventFineFullInfo;
    }


    public function deleteEvent($eventFineId,rentEvent $eventObj)
    {
        $timeSheetObj = $this->timeSheetRep->getTimeSheetByEvent($eventObj,$eventFineId);
        $this->timeSheetRep->delTimeSheet($timeSheetObj);

        $eventFineObj = $this->eventFineRep->getEventFine($eventFineId);
        $this->eventFineRep->delEventFine($eventFineObj);
    }



}
