<?php
namespace App\Services;


use App\Models\rentEvent;

use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\EventDocumentTitleRepository;
use Carbon\CarbonPeriod;



Class EventDocumentTitleService implements EventServiceInterface{

    private $timeSheetRep,$toPaymentRep,$eventObj,$contractRep,$eventDocumentTitleRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventDocumentTitleRep = new EventDocumentTitleRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventDocumentTitleRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvents;

    }

  public function getEventModel($modelId = null)
  {

  }


    public function getEventInfo($dataId = null)
    {
        return $this->eventDocumentTitleRep->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {

    }



    public function store()
    {


    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {

    }


}
