<?php
namespace App\Services;

use App\Models\rentEvent;
use App\Repositories\EventRentalRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Requests\Event;
use Illuminate\Support\Facades\DB;


Class EventRentalService implements EventServiceInterface {
    private $eventRentalRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventRentalRep = new EventRentalRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }


    public function index(CarbonPeriod $datePeriod)
    {
        $resultEvents = $this->eventRentalRep->getEventRentals($this->eventObj->id,$datePeriod);
        return $resultEvents;
    }

   public function getEventModel($modelId = null)
   {
       return $this->eventRentalRep->getEventRental($modelId);
   }


   public function getAdditionalViewDataArray()
   {
       return ['lastTimeSheet'];
   }

   public function store()
   {
       $eventRentalRequest = app()->make(Event\RentalRequest::class);
       $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

       DB::beginTransaction();
       try {
           $eventRentalModel = $this->eventRentalRep->getEventRental($eventRentalRequest->get('id'));
           $eventRentalModel->contractId = $eventRentalRequest->get('contractId');
           $eventRentalModel = $this->eventRentalRep->addEventRental($eventRentalModel);

           $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventRentalModel->id);

           $timeSheetModel->carId = $eventRentalRequest->get('carId');
           $timeSheetModel->eventId = $this->eventObj->id;
           $timeSheetModel->dataId = $eventRentalModel->id;
           $timeSheetModel->dateTime = $eventRentalRequest->get('dateTime');
           $timeSheetModel->comment = $eventRentalRequest->get('comment');
           $timeSheetModel->duration = $eventRentalRequest->get('duration');
           $timeSheetModel->color = $this->eventObj->color;
           $timeSheetModel->pId = $eventTimeSheetRequest->get('parentId');

           $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);


           $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);

           $toPaymentModel->timeSheetId = $timeSheetModel->id;
           $toPaymentModel->sum = $eventRentalRequest->get('sum');

           $toPaymentModel->contractId = $eventRentalRequest->get('contractId');
           $contractModel = $this->contractRep->getContract($eventRentalRequest->get('contractId'));

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



    public function getEventInfo($dataId = null)
    {
        return $this->eventRentalRep->getEventRentalFullInfo($this->eventObj->id,$dataId);
    }



    public function destroy($dataId)
    {
        $eventRentalModel = $this->eventRentalRep->getEventRental($dataId);
        $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventRentalModel->id);
        $toPaymentModel = $this->toPaymentRep->getToPaymentByTimeSheet($timeSheetModel->id);
        DB::beginTransaction();
        try {
            $this->toPaymentRep->delToPayment($toPaymentModel);
            $this->timeSheetRep->delTimeSheet($timeSheetModel);
            $this->eventRentalRep->delEvent($eventRentalModel);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

    }


    public function addEvent($dataArray)
    {
        $startDateText = $dataArray['dateStart'].' '.$dataArray['timeStart'];
        $finishDateText = $dataArray['dateFinish'].' '.$dataArray['timeFinish'];
        $startCarbon = new Carbon($startDateText);




        $diffMinutes = $startCarbon->diffInMinutes($finishDateText);
        $colIteration = floor($diffMinutes/$dataArray['duration']);
        $deltaMinutes = $diffMinutes-$colIteration*$dataArray['duration'];

        $timeSheetObj = new timeSheet();
        $timeSheetObj->carId = $dataArray['carId'];
        $timeSheetObj->eventId = $dataArray['eventId'];
        $timeSheetObj->comment = '';
        $timeSheetObj->color =  $dataArray['color'];
        $timeSheetObj->duration = $dataArray['duration'];

        $toPaymentObj = new toPayment();
        $toPaymentObj->contractId = $dataArray['contractId'];

        for ($i = 0; $i < $colIteration; $i++)
        {
            $rentEventObj = new rentEventRental();
            $rentEventObj->contractId = $dataArray['contractId'];
            $rentEventObj = $this->eventRentalRep->addEventRental($rentEventObj);

            $timeSheetRep = $timeSheetObj->replicate();
            $timeSheetRep->dateTime = $startCarbon->toDateTimeString();
            $startCarbon->addDays(1);
            $timeSheetRep->dataId = $rentEventObj->id;
            $timeSheetRep = $this->timeSheetRep->addTimeSheet($timeSheetRep);

            $toPaymentRep = $toPaymentObj->replicate();
            $toPaymentRep->sum = $dataArray['sum'][$i]??0;
            $toPaymentRep->timeSheetId =  $timeSheetRep->id;
            $toPaymentRep = $this->toPaymentRep->addToPayment($toPaymentRep);
        }
        if ($deltaMinutes){
            $timeSheetRep = $timeSheetObj->replicate();
            $toPaymentRep = $toPaymentObj->replicate();

            $timeSheetRep->dateTime = $startCarbon->toDateTimeString();
            $timeSheetRep->sum = $dataArray['sum'][$colIteration]??0;
            $timeSheetRep->duration =$deltaMinutes;
            $timeSheetRep = $this->timeSheetRep->addTimeSheet($timeSheetRep);

            $toPaymentRep->sum = $dataArray['sum'][$i]??0;;
            $toPaymentRep->timeSheetId = $timeSheetObj->id;
            $toPaymentRep = $this->toPaymentRep->addToPayment($toPaymentRep);
        }
    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {
        $eventsObj=$this->eventRentalRep->getEventRentals($eventId,$periodDate);
        $eventsObj->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        //$eventsObj->dd();
        //$eventsObj=$this->timeSheetRep->getTimeSheetsByEvent($eventId,$periodDate);
        return $eventsObj;
    }

    public function getEventRentalInfo($eventId,$eventRentalId)
    {
        $eventRentalObj = $this->eventRentalRep->getEventRentalFullInfo($eventId,$eventRentalId);
        //$eventRentalObj->dd();
        //var_dump($eventRentalObj);
        return $eventRentalObj;
    }


    public function getEventRental($eventId): rentEventRental
    {
        $eventRentalObj = $this->eventRentalRep->getEventRental($eventId);
        return $eventRentalObj;
    }



}
