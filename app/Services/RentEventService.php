<?php
namespace App\Services;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use Illuminate\Http\Request;

Class RentEventService{
    private $rentEventRep,$request;

    function __construct(RentEventRepositoryInterface $rentEventRep,Request $request)
    {
        $this->rentEventRep=$rentEventRep;
        $this->request=$request;
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


    public function addRentEvent()
    {
        $validate=$this->request->validate(['name'=>'required',
            'color'=>'required',
            'action'=>'required'
        ]);

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

