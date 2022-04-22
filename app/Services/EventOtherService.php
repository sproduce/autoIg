<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Http\Requests\Event;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;


Class EventOtherService{

    private $timeSheetModel,$toPaymentModel;

    function __construct(timeSheet $timeSheetModel,toPayment $toPaymentModel)
    {
        $this->timeSheetModel = $timeSheetModel;
        $this->toPaymentModel =  $toPaymentModel;
    }


    public function addEvent(Event\OtherRequest $eventOther,rentEvent $eventObj)
    {
        $this->timeSheetModel->carId =
        $this->timeSheetModel->eventId = $eventObj->id;
        $this->timeSheetModel->dateTime = $eventOther->get('dateTimeOther');
        $this->timeSheetModel->comment = $eventOther->get('commentOther');
        $this->timeSheetModel->duration = $eventObj->duration;
        $this->timeSheetModel->color = $eventObj->color;
        $this->timeSheetModel->save();

        $this->toPaymentModel->timeSheetId = $this->timeSheetModel->id;
        $this->toPaymentModel->carId=$eventOther->get('carId');;
        $this->toPaymentModel->sum=$eventOther->get('sumOther');;
        $this->toPaymentModel->save();
    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
