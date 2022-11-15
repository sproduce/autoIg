<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventServiceRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\MotorPoolRepository;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


Class EventServiceService implements EventServiceInterface{

    private $eventServiceRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventServiceRep = new EventServiceRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
        $this->contractRep = $contractRep;
    }

    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
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


    public function getViews()
    {

    }


    public function store($dataCollection = null)
    {
        $eventServiceRequest = app()->make(Event\ServiceRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);
        $carRepObj = new MotorPoolRepository();
        $carObj = $carRepObj->getCar($eventServiceRequest->get('carId'));
        //$eventTimeSheetRequest->dd();
        DB::beginTransaction();
        try {
            $eventServiceModel = $this->eventServiceRep->getEvent($eventServiceRequest->get('id'));

            $eventServiceModel->comment = $eventServiceRequest->get('comment');
            $eventServiceModel->contractId = $eventServiceRequest->get('contractId');
            $eventServiceModel->subjectId = $eventServiceRequest->get('subjectId');
            //$eventServiceModel->sum = $eventServiceRequest->get('sum');

            $eventServiceModel = $this->eventServiceRep->addEvent($eventServiceModel);

            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventServiceModel->id);

            $timeSheetModel->carId = $eventServiceRequest->get('carId');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventServiceModel->id;
            $timeSheetModel->dateTime = $eventServiceRequest->get('dateTime');
            $timeSheetModel->mileage = $eventServiceRequest->get('mileage');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);

            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

            $toPaymentModel->payUp =  $timeSheetModel->dateTime->addMinutes($timeSheetModel->duration);

            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventServiceRequest->get('sum');
            $toPaymentModel->subjectIdTo = $eventServiceRequest->get('subjectId');
            $toPaymentModel->subjectIdFrom = $carObj->subjectIdOwner;
            $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    public function destroy($dataId)
    {
        $eventServiceModel = $this->eventServiceRep->getEvent($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventServiceModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventServiceRep->delEvent($eventServiceModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    }


    public function getEventInfo($dataId = null)
    {
        $result = $this->eventServiceRep->getEventFullInfo($this->eventObj->id,$dataId);
        return  $result;
    }



    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
