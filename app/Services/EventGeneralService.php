<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventGeneralRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;



Class EventGeneralService implements EventServiceInterface{

    private $eventGeneralRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventGeneralRep = new EventGeneralRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    public function index(CarbonPeriod $datePeriod)
    {
//        $resultEvent = $this->eventOtherRep->getEvents($this->eventObj->id,$datePeriod);
//        return $resultEvent;
    }

  public function getEventModel($modelId = null)
  {
      return $this->eventGeneralRep->getEvent($modelId);
  }


    public function getEventInfo($dataId = null)
    {
        return $this->eventGeneralRep->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {
        return [];
    }



    public function store()
    {
        $eventGeneralRequest = app()->make(Event\GeneralRequest::class);


    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {
        // TODO: Implement destroy() method.
    }


}
