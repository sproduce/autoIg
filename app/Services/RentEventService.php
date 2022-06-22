<?php
namespace App\Services;
use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;


Class RentEventService{
    private $rentEventRep,$timeSheetRep,$toPaymentRep;

    function __construct(
        RentEventRepositoryInterface $rentEventRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep
    ){
        $this->rentEventRep = $rentEventRep;
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
    }


    public function getRentEvents()
    {
        $rentEventsObj=$this->rentEventRep->getEvents();
        return $rentEventsObj;
    }


    public function getEventService(rentEvent $eventObj): EventServiceInterface
    {
        $serviceName = '\App\Services\\'.ucfirst($eventObj->action).'Service';

        return (new $serviceName($this->timeSheetRep,$this->toPaymentRep,$eventObj));
    }


    public function getRentEvent($eventId):rentEvent
    {
        $rentEventObj = $this->rentEventRep->getEvent($eventId);
        return $rentEventObj;
    }


    public function addRentEvent($validate)
    {
        $this->rentEventRep->addEvent($validate);
    }

    public function updateRentEvent($eventArray)
    {
        $rentEventId=$eventArray['id'];
        $rentEventArray['name']=$eventArray['name'];
        $rentEventArray['color']=$eventArray['color'];
        $rentEventArray['action']=$eventArray['action'];
        $rentEventArray['priority']=$eventArray['priority'] ?? 0;
        $rentEventArray['duration']=$eventArray['duration'] ?? 1;
        $rentEventArray['isToPay']=$eventArray['isToPay']?? 0;
        $rentEventArray['payOperationTypeId']=$eventArray['payOperationTypeId'];

        $this->rentEventRep->updateEvent($rentEventId,$rentEventArray);
    }


    public function getEventExtendedObjs($eventId,$dataId)
    {
//        $timeSheetObj = $this->timeSheet
//            ->where('eventId',$eventId)
//            ->where('dataId',$dataId)
//            ->first();
//        $toPaymentObj = $this->toPayment
//            ->where('');

    }


    public function getAllEvents()
    {

    }



}

