<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventDocumentInsuranceRepository;
use App\Repositories\EventOtherRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


Class EventDocumentInsuranceService implements EventServiceInterface{

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



    public function store()
    {
        $eventDocumentInsuranceRequest = app()->make(Event\DocumentInsuranceRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {

            $eventDocumentInsuranceModel = $this->eventDocumentInsuranceRep->getEvent($eventDocumentInsuranceRequest->get('id'));
            $eventDocumentInsuranceModel->number = $eventDocumentInsuranceRequest->get('number');
            $eventDocumentInsuranceModel->expiration = $eventDocumentInsuranceRequest->get('expiration');

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
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {

    }


}
