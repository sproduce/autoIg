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
        $resultEvents = $this->eventFineRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvents;
    }

   public function getEventModel($modelId = null)
   {
       return $this->eventFineRep->getEvent($modelId);
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
        $eventFineRequest = app()->make(Event\FineRequest::class);

        $eventFineModel = $this->eventFineRep->getEvent($eventFineRequest->get('id'));

        $eventFineModel->dateTimeOrder = $eventFineRequest->get('dateOrder');
        $eventFineModel->datePayMax = $eventFineRequest->get('datePayMax');
        $eventFineModel->datePaySale = $eventFineRequest->get('datePaySale');
        $eventFineModel->dateTimeFine = $eventFineRequest->get('dateTimeFine');
        $eventFineModel->sum = $eventFineRequest->get('sum');
        $eventFineModel->sumSale = $eventFineRequest->get('sumSale');
        $eventFineModel->uin = $eventFineRequest->get('uin');

        $eventFineModel = $this->eventFineRep->addEvent($eventFineModel);

        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventFineModel->id);

        $timeSheetModel->carId = $eventFineRequest->get('carId');
        $timeSheetModel->eventId = $this->eventObj->id;
        $timeSheetModel->dataId = $eventFineModel->id;
        $timeSheetModel->dateTime = $eventFineRequest->get('dateTimeFine');
        $timeSheetModel->comment = $eventFineRequest->get('comment');
        $timeSheetModel->duration = $this->eventObj->duration;
        $timeSheetModel->color = $this->eventObj->color;
        $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);


        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
        $toPaymentModel->timeSheetId = $timeSheetModel->id;
        $toPaymentModel->sum = $eventFineRequest->get('sumSale');

        $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);


    }


    public function getEventInfo($dataId = null)
    {
        return $this->eventFineRep->getEventFullInfo($this->eventObj->id,$dataId);
    }



    public function destroy($dataId)
    {
        // TODO: Implement destroy() method.
    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj = $this->eventFineRep->getEventFines($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }


}
