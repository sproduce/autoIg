<?php
namespace App\Services;


use App\Http\Requests\CarIdDate;
use App\Models\rentEvent;
use App\Models\rentEventFine;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Http\Requests\Event;
use App\Repositories\EventFineRepository;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

Class EventFineService{
    private $timeSheetModel,$toPaymentModel,$rentEventFineModel,$eventFineRep;

    function __construct(
        timeSheet $timeSheetModel,
        toPayment $toPaymentModel,
        rentEventFine $rentEventFineModel,
        EventFineRepository $eventFineRep
    ){
        $this->timeSheetModel = $timeSheetModel;
        $this->toPaymentModel = $toPaymentModel;
        $this->rentEventFineModel = $rentEventFineModel;
        $this->eventFineRep = $eventFineRep;
    }


    public function addEvent(Event\FineRequest $fineRequest,rentEvent $eventObj)
    {

        if ($fineRequest->get('id')){
            $this->rentEventFineModel = $this->rentEventFineModel->find($fineRequest->get('id'));
            $this->timeSheetModel =  $this->timeSheetModel->where('eventId',$eventObj->id)->where('dataId',$fineRequest->get('id'))->first();
        }


        $this->rentEventFineModel->dateTimeOrder = $fineRequest->get('dateOrder');
        $this->rentEventFineModel->datePayMax = $fineRequest->get('datePayMax');
        $this->rentEventFineModel->datePaySale = $fineRequest->get('datePaySale');
        $this->rentEventFineModel->dateTimeFine = $fineRequest->get('dateTimeFine');
        $this->rentEventFineModel->sum = $fineRequest->get('sum');
        $this->rentEventFineModel->sumSale = $fineRequest->get('sumSale');
        $this->rentEventFineModel->save();

        $this->timeSheetModel->carId = $fineRequest->get('carId');
        $this->timeSheetModel->dataId = $this->rentEventFineModel->id;
        $this->timeSheetModel->eventId = $eventObj->id;
        $this->timeSheetModel->dateTime = $fineRequest->get('dateTimeFine');
        $this->timeSheetModel->duration = $eventObj->duration;
        $this->timeSheetModel->color = $eventObj->color;
        $this->timeSheetModel->save();

        if (!$fineRequest->get('id')){
            $this->toPaymentModel->sum = -1 * abs($fineRequest->get('sumSale'));
            $this->toPaymentModel->timeSheetId =  $this->timeSheetModel->id;
            $this->toPaymentModel->save();
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

    public function getEventFullInfo($eventId,rentEvent $eventObj,CarIdDate $carIdDate)
    {
        if ($eventId){

        }

        $eventFineFullInfo = collect([
            'eventObj' => $eventObj,
            'eventFineObj' => $this->rentEventFineModel,
            'toPayObj' => $this->toPaymentModel,
            'timeSheetObj' => $this->timeSheetModel,
        ]);

        return  $eventFineFullInfo;
    }



}
