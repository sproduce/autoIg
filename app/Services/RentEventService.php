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

    public function addRentEvent()
    {
        $validate=$this->request->validate(['name'=>'required',
            'color'=>'required',
            'action'=>'required'
        ]);

        $this->rentEventRep->addEvent($validate);
    }



}
