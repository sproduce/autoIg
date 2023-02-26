<?php
namespace App\Services;


use App\Models\rentEvent;

use App\Http\Requests\Event;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\EventDocumentTitleRepository;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\timeSheet;

Class EventDocumentCarTitleService implements EventServiceInterface{

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

    
    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
    }
    
    function setEventObj(rentEvent $eventObj) 
    {
        if ($eventObj->duration=="eventDocumentTitle"&& $eventObj->id){
            $this->eventObj = $eventObj;
        }
        
    }
    
    
    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventDocumentTitleRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvents;

    }

  public function getEventModel($modelId = null)
  {
      return $this->eventDocumentTitleRep->getEvent($modelId);
  }


    public function getEventInfo($dataId = null)
    {
        $filter = ['dataId' => $dataId];
        return $this->eventDocumentTitleRep->getEventFullInfo($this->eventObj->id,$filter);
    }

    
    function getEventInfoByNumber($number) 
    {
         $filter = ['number' => $number];
         return $this->eventDocumentTitleRep->getEventFullInfo($this->eventObj->id,$filter);
    }
    
    
    
    
    public function getAdditionalViewDataArray()
    {

    }



    public function store($dataCollection = null): timeSheet
    {
        $eventDocumentTitleRequest = app()->make(Event\DocumentTitleRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {
            $eventDocumentTitleModel = $this->eventDocumentTitleRep->getEvent($eventDocumentTitleRequest->get('id'));
            $eventDocumentTitleModel->number = $eventDocumentTitleRequest->get('number');
            $eventDocumentTitleModel->color = $eventDocumentTitleRequest->get('color');
            $eventDocumentTitleModel->passport = $eventDocumentTitleRequest->get('passport');
            $eventDocumentTitleModel->regNumber = $eventDocumentTitleRequest->get('regNumber');
            $eventDocumentTitleModel->issued = $eventDocumentTitleRequest->get('issued');
            $eventDocumentTitleModel->subjectId = $eventDocumentTitleRequest->get('subjectId');
            $eventDocumentTitleModel->ownerSubjectId = $eventDocumentTitleRequest->get('ownerSubjectId');
            $eventDocumentTitleModel->marks = $eventDocumentTitleRequest->get('marks');
            $eventDocumentTitleModel->dateDocument = $eventDocumentTitleRequest->get('dateDocument');
            
            $eventDocumentTitleModel = $this->eventDocumentTitleRep->addEvent($eventDocumentTitleModel);
            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventDocumentTitleModel->id);

            $timeSheetModel->carId = $eventDocumentTitleRequest->get('carId');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventDocumentTitleModel->id;
            $timeSheetModel->dateTime = $eventDocumentTitleRequest->get('date');
            $timeSheetModel->comment = $eventDocumentTitleRequest->get('comment');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');
            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->subjectIdTo = $eventDocumentTitleRequest->get('subjectId');
            $toPaymentModel->sum = $eventDocumentTitleRequest->get('sum');

            $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);



            DB::commit();
            return $timeSheetModel;
        } catch (\Exception $e) {
            DB::rollback();
            echo  $e->getMessage();
            exit();
        }

    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {
        $eventDocumentTitleModel = $this->eventDocumentTitleRep->getEvent($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventDocumentTitleModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventDocumentTitleRep->delEvent($eventDocumentTitleModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        
        
    }

    
    
    public function getNumbers() 
    {
        return $this->eventDocumentTitleRep->getNumbers($this->eventObj->id);
    }

    
    
    public function getLastByCar($carId) 
    {
        
        //$timeSheetObj = $this->timeSheetRep->getLastTimeSheet($carObj, $eventObj)
    }
    
    
    
}
