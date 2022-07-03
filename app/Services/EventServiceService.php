<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventServiceRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;



Class EventServiceService implements EventServiceInterface{

    private $eventServiceRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventServiceRep = new EventServiceRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
        $this->contractRep = $contractRep;
    }

    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvent = $this->eventServiceRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvent;
    }

    public function getEventModel($modelId = null)
    {
        return $this->eventServiceRep->getEvent($modelId);
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
        $eventServiceRequest = app()->make(Event\ServiceRequest::class);

        $eventServiceModel = $this->eventServiceRep->getEvent($eventServiceRequest->get('id'));

        $eventServiceModel->comment = $eventServiceRequest->get('comment');
        $eventServiceModel->contractId = $eventServiceRequest->get('contractId');
        $eventServiceModel->subjectId = $eventServiceRequest->get('subjectId');
        $eventServiceModel->sum = $eventServiceRequest->get('sum');
        $eventServiceModel = $this->eventServiceRep->addEvent($eventServiceModel);

        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventServiceModel->id);

        $timeSheetModel->carId = $eventServiceRequest->get('carId');
        $timeSheetModel->eventId = $this->eventObj->id;
        $timeSheetModel->dataId = $eventServiceModel->id;
        $timeSheetModel->dateTime = $eventServiceRequest->get('dateTime');
        $timeSheetModel->mileage = $eventServiceRequest->get('mileage');
        $timeSheetModel->duration = $this->eventObj->duration;
        $timeSheetModel->color = $this->eventObj->color;
        $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

        $toPaymentModel->timeSheetId = $timeSheetModel->id;
        $toPaymentModel->sum = $eventServiceRequest->get('sum');
        $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);

    }

    public function destroy($dataId)
    {
        // TODO: Implement destroy() method.
    }


    public function getEventInfo($dataId = null)
    {
        return  $this->eventServiceRep->getEventFullInfo($this->eventObj->id,$dataId);
    }


    public function addEvent(Event\OtherRequest $eventOther,rentEvent $eventObj)
    {
        $this->timeSheetModel->carId = $eventOther->get('carId');
        $this->timeSheetModel->eventId = $eventObj->id;
        $this->timeSheetModel->dateTime = $eventOther->get('dateTimeOther');
        $this->timeSheetModel->comment = $eventOther->get('commentOther');
        $this->timeSheetModel->duration = $eventObj->duration;
        $this->timeSheetModel->color = $eventObj->color;
        $this->timeSheetModel->save();

        $this->toPaymentModel->timeSheetId = $this->timeSheetModel->id;
        $this->toPaymentModel->carId=$eventOther->get('carId');
        $this->toPaymentModel->sum=$eventOther->get('sumOther');
        $this->toPaymentModel->save();
    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
