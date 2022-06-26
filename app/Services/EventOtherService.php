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


    public function getEventInfo($dataId)
    {
        return $this->eventOtherRep->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {
        return [];
    }



    public function store()
    {
        $eventOtherRequest = app()->make(Event\OtherRequest::class);

        $eventOtherObj = $this->eventOtherRep->getEvent($eventOtherRequest->get('idOther'));

        $eventOtherObj->save();

        $timeSheetModel = $this->timeSheetRep->getTimeSheet(null);

        $timeSheetModel->carId = $eventOtherRequest->get('carIdOther');
        $timeSheetModel->eventId = $this->eventObj->id;
        $timeSheetModel->dataId = $eventOtherObj->id;
        $timeSheetModel->dateTime = $eventOtherRequest->get('dateTimeOther');
        $timeSheetModel->comment = $eventOtherRequest->get('commentOther');
        $timeSheetModel->duration = $this->eventObj->duration;
        $timeSheetModel->color = $this->eventObj->color;
        $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

        $toPaymentModel = $this->toPaymentRep->getToPayment(null);

        $toPaymentModel->timeSheetId = $timeSheetModel->id;
        $toPaymentModel->sum = $eventOtherRequest->get('sumOther');
        if ($eventOtherRequest->get('contractIdOther')){
            $toPaymentModel->contractId = $eventOtherRequest->get('contractIdOther');
            $contractModel = $this->contractRep->getContract($eventOtherRequest->get('contractIdOther'));
            $toPaymentModel->subjectIdFrom = $contractModel->subjectIdTo;
            $toPaymentModel->subjectIdTo = $contractModel->subjectIdFrom;
        }



        $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);

    }

    public function getViews()
    {

    }

    public function addEvent(Event\OtherRequest $eventOtherRequest,rentEvent $eventObj)
    {

    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
