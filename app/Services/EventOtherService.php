<?php
namespace App\Services;

use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\ToPaymentRepository;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;


Class EventOtherService{
    private $timeSheetRep,$photoServ,$eventPhotocontrolRep,$toPaymentRep;

    function __construct(EventPhotocontrolRepository $eventPhotocontrolRep,TimeSheetRepositoryInterface $timeSheetRep,PhotoService $photoServ,ToPaymentRepository $toPaymentRep)
    {
        $this->eventPhotocontrolRep=$eventPhotocontrolRep;
        $this->timeSheetRep=$timeSheetRep;
        $this->photoServ=$photoServ;
        $this->toPaymentRep=$toPaymentRep;
    }


    public function addEvent()
    {


    }

    public function getEvents(CarbonPeriod $periodDate,$eventId)
    {

    }



}
