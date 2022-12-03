<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventOtherRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\timeSheet;

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

    
    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
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


    public function getEventInfo($dataId = null)
    {
        return $this->eventOtherRep->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {
        return [];
    }



    public function store($dataCollection = null): timeSheet
    {
        $eventOtherRequest = app()->make(Event\OtherRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {
            $eventOtherModel = $this->eventOtherRep->getEvent($eventOtherRequest->get('idOther'));
            $eventOtherModel->comment = $eventOtherRequest->get('commentOther');
            $eventOtherModel->contractId = $eventOtherRequest->get('contractIdOther');
            $eventOtherModel = $this->eventOtherRep->addEvent($eventOtherModel);

            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventOtherModel->id);

            $timeSheetModel->carId = $eventOtherRequest->get('carIdOther');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventOtherModel->id;
            $timeSheetModel->dateTime = $eventOtherRequest->get('dateTimeOther');
            $timeSheetModel->comment = $eventOtherRequest->get('commentOther');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);


            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventOtherRequest->get('sumOther');
            $toPaymentModel->payUp =  $timeSheetModel->dateTime->addMinutes($timeSheetModel->duration);
            if ($eventOtherRequest->get('contractIdOther')){
                $toPaymentModel->contractId = $eventOtherRequest->get('contractIdOther');
                $contractModel = $this->contractRep->getContract($eventOtherRequest->get('contractIdOther'));
                $toPaymentModel->subjectIdFrom = $contractModel->subjectIdTo;
                $toPaymentModel->subjectIdTo = $contractModel->subjectIdFrom;
            }



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
        $eventOtherModel = $this->eventOtherRep->getEvent($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventOtherModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventOtherRep->delEvent($eventOtherModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }


    }


}
