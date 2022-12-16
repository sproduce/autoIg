<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventDocumentInsuranceRepository;

use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\timeSheet;

Class EventDocumentCarService implements EventServiceInterface{

    private $timeSheetRep,$toPaymentRep,$eventObj,$contractRep,$eventDocumentInsuranceRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventDocumentInsuranceRep = new EventDocumentInsuranceRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    
    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
    }
    
    
    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventDocumentInsuranceRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvents;
    }

    public function getEventModel($modelId = null)
    {

    }


    public function getEventInfo($dataId = null)
    {
        return $this->eventDocumentInsuranceRep->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {

    }



    public function store($dataCollection = null): timeSheet
    {
        $eventDocumentInsuranceRequest = app()->make(Event\DocumentInsuranceRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {

            $eventDocumentInsuranceModel = $this->eventDocumentInsuranceRep->getEvent($eventDocumentInsuranceRequest->get('id'));
            $eventDocumentInsuranceModel->number = $eventDocumentInsuranceRequest->get('number');
            $eventDocumentInsuranceModel->marks = $eventDocumentInsuranceRequest->get('marks');
            $eventDocumentInsuranceModel->comment = $eventDocumentInsuranceRequest->get('comment');
            $eventDocumentInsuranceModel->expiration = $eventDocumentInsuranceRequest->get('expiration');
            $eventDocumentInsuranceModel->dateDocument = $eventDocumentInsuranceRequest->get('dateDocument');
            $eventDocumentInsuranceModel->subject = $eventDocumentInsuranceRequest->get('subjectId');
            $eventDocumentInsuranceModel->subjectTo = $eventDocumentInsuranceRequest->get('subjectToId');
            

            $eventDocumentInsuranceModel = $this->eventDocumentInsuranceRep->addEvent($eventDocumentInsuranceModel);

            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventDocumentInsuranceModel->id);

            $timeSheetModel->carId = $eventDocumentInsuranceRequest->get('carId');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventDocumentInsuranceModel->id;
            $timeSheetModel->dateTime = $eventDocumentInsuranceRequest->get('date');
            $timeSheetModel->comment = $eventDocumentInsuranceRequest->get('comment');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');
            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventDocumentInsuranceRequest->get('sum');

            $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);



            DB::commit();
            return $timeSheetModel;
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            exit();
        }
    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {

    }


}
