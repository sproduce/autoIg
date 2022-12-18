<?php
namespace App\Services;
use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Models\toPayment;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;


Class RentEventService{
    private $rentEventRep,$timeSheetRep,$toPaymentRep,$contractRep,$servicesObj=[];

    function __construct(
        RentEventRepositoryInterface $rentEventRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        ContractRepositoryInterface $contractRep
    ){
        $this->rentEventRep = $rentEventRep;
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->contractRep = $contractRep;
    }




    public function getRentEvents()
    {
        $rentEventsObj = $this->rentEventRep->getEvents();
        return $rentEventsObj;
    }

   
    public function getEventService(rentEvent $eventObj): EventServiceInterface
    {
        if (isset($this->servicesObj[$eventObj->id])) return $this->servicesObj[$eventObj->id];
        
        $serviceName = '\App\Services\\'.ucfirst($eventObj->action).'Service';
        $this->servicesObj[$eventObj->id] = new $serviceName($this->contractRep,$this->timeSheetRep,$this->toPaymentRep,$eventObj);
        
        return $this->servicesObj[$eventObj->id];
    }

    
    function getEventData(rentEvent $eventObj)
    {
        
    }
    

    
    public function getRentEvent($eventId): rentEvent
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
        $rentEventId = $eventArray['id'];
        $rentEventArray['name'] = $eventArray['name'];
        $rentEventArray['color'] = $eventArray['color'];
        $rentEventArray['colorPartPay'] = $eventArray['colorPartPay'];
        $rentEventArray['colorPay'] = $eventArray['colorPay'];
        $rentEventArray['action'] = $eventArray['action'];
        $rentEventArray['priority'] = $eventArray['priority'] ?? 0;
        $rentEventArray['duration'] = $eventArray['duration'] ?? 1;
        $rentEventArray['visibleTimeSheet'] = $eventArray['visibleTimeSheet']?? 0;
        $rentEventArray['payOperationTypeId'] = $eventArray['payOperationTypeId'];

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

