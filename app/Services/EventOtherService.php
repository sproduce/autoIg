<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventOtherRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;



Class EventOtherService implements EventServiceInterface{

    private $eventOtherRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventOtherRep = new EventOtherRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvent = $this->eventOtherRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvent;
    }

  public function getEventModel($modelId = null)
  {
      return $this->eventOtherRep->getEvent($modelId);
  }


    public function getAdditionalViewDataArray()
    {
        return [];
    }



    public function store()
    {
        $eventOther = app()->make(Event\OtherRequest::class);
        $timeSheetModel = $this->timeSheetRep->getTimeSheet($eventOther->get('id'));

        $timeSheetModel->carId = $eventOther->get('carId');
        $timeSheetModel->eventId = $this->eventObj->id;
        $timeSheetModel->dateTime = $eventOther->get('dateTimeOther');
        $timeSheetModel->comment = $eventOther->get('commentOther');
        $timeSheetModel->duration = $this->eventObj->duration;
        $timeSheetModel->color = $this->eventObj->color;
        $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

        $toPaymentModel = $this->toPaymentRep->getToPayment(null);

        $toPaymentModel->timeSheetId = $timeSheetModel->id;
        $toPaymentModel->sum = $eventOther->get('sumOther');
        if ($eventOther->get('contractId')){
            $toPaymentModel->contractId = $eventOther->get('contractId');
            $contractModel = $this->contractRep->getContract($eventOther->get('contractId'));
            $toPaymentModel->subjectIdFrom = $contractModel->subjectIdTo;
            $toPaymentModel->subjectIdTo = $contractModel->subjectIdFrom;
        }



        $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);

    }

    public function getViews()
    {

    }

    public function addEvent(Event\OtherRequest $eventOther,rentEvent $eventObj)
    {

    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
