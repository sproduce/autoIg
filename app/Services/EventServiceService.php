<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Http\Requests\Event;
use App\Repositories\EventOtherRepository;
use App\Repositories\EventServiceRepository;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;



Class EventServiceService implements EventServiceInterface{

    private $eventServiceRep,$timeSheetRep,$toPaymentRep,$eventObj;

    function __construct(
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventServiceRep = new EventServiceRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
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


    public function getRequestRules()
    {
        // TODO: Implement getRequestRules() method.
    }

    public function getViews()
    {

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