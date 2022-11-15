<?php
namespace App\Services;


use App\Http\Requests\Event;
use App\Models\rentEvent;
use App\Repositories\EventFineRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

Class EventFineService implements EventServiceInterface {
    private $eventFineRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->eventFineRep = new EventFineRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->contractRep = $contractRep;
        $this->eventObj = $eventObj;
    }

    
    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
    }

    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventFineRep->getEvents($this->eventObj->id,$datePeriod);
        return $resultEvents;
    }

   public function getEventModel($modelId = null)
   {
       return $this->eventFineRep->getEvent($modelId);
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
        if ($dataCollection){
            $eventFineRequest = $dataCollection;
        } else {
            $eventFineRequest = app()->make(Event\FineRequest::class);
        }
        
        //$eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {
            $eventFineModel = $this->eventFineRep->getEvent($eventFineRequest->get('id'));

            $eventFineModel->dateTimeOrder = $eventFineRequest->get('dateOrder');
            $eventFineModel->datePayMax = $eventFineRequest->get('datePayMax');
            $eventFineModel->datePaySale = $eventFineRequest->get('datePaySale');
            $eventFineModel->dateTimeFine = $eventFineRequest->get('dateTimeFine');
            $eventFineModel->sum = $eventFineRequest->get('sum');
            $eventFineModel->sumSale = $eventFineRequest->get('sumSale');
            $eventFineModel->uin = $eventFineRequest->get('uin');

            $eventFineModel = $this->eventFineRep->addEvent($eventFineModel);

            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventFineModel->id);

            $timeSheetModel->carId = $eventFineRequest->get('carId');
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventFineModel->id;
            $timeSheetModel->dateTime = $eventFineRequest->get('dateTimeFine');
            $timeSheetModel->comment = $eventFineRequest->get('comment');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId = $eventFineRequest->get('parentId');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);


            $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
            $toPaymentModel->payUp = $eventFineModel->datePaySale;
            $toPaymentModel->timeSheetId = $timeSheetModel->id;
            $toPaymentModel->sum = $eventFineRequest->get('sumSale')*-1;

            $toPaymentModel = $this->toPaymentRep->addToPayment($toPaymentModel);

            DB::commit();
            return $timeSheetModel->id;
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    public function getEventInfo($dataId = null)
    {
        $result = $this->eventFineRep->getEventFullInfo($this->eventObj->id,$dataId);
        return $result;
    }



    public function destroy($dataId)
    {
        $eventFineModel = $this->eventFineRep->getEvent($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventFineModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventFineRep->delEvent($eventFineModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj = $this->eventFineRep->getEventFines($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });
        return $eventsObj;
    }


}
