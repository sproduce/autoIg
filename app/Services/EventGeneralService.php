<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventGeneralRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


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
        $resultEvent = $this->eventGeneralRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvent;
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



    public function store($dataCollection = null)
    {
        $eventGeneralRequest = app()->make(Event\GeneralRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {

            $eventGeneralModel = $this->eventGeneralRep->getEvent($eventGeneralRequest->get('id'));
            $eventGeneralModel->comment = $eventGeneralRequest->get('comment');
            $eventOtherModel = $this->eventGeneralRep->addEvent($eventGeneralModel);

            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventOtherModel->id);
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventOtherModel->id;
            $timeSheetModel->dateTime = $eventGeneralRequest->get('dateTime');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventGeneralRequest->get('sum');

            $toPaymentModel->contractId = $eventGeneralRequest->get('contractId');
            $contractModel = $this->contractRep->getContract($eventGeneralRequest->get('contractId'));
            $toPaymentModel->subjectIdFrom = $contractModel->subjectIdTo;
            $toPaymentModel->subjectIdTo = $contractModel->subjectIdFrom;

            $toPaymentModel->payUp =  $timeSheetModel->dateTime->addMinutes($timeSheetModel->duration);

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
        $eventGeneralModel = $this->eventGeneralRep->getEvent($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventGeneralModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventGeneralRep->delEvent($eventGeneralModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    }


}
