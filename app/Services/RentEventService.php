<?php
namespace App\Services;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use Illuminate\Http\Request;

Class RentEventService{
    private $rentEventRep;

    function __construct(
        RentEventRepositoryInterface $rentEventRep
    ) {
        $this->rentEventRep=$rentEventRep;
    }


    public function getTest()
    {
        return 1;
    }

    public function getRentEvents()
    {
        $rentEventsObj=$this->rentEventRep->getEvents();
        return $rentEventsObj;
    }

    public function getRentEvent($eventId)
    {
        $rentEventObj=$this->rentEventRep->getEvent($eventId);
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



}

