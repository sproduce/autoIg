<?php

namespace App\Http\Controllers;

use App\Services\RentEventService;
use Illuminate\Http\Request;


class RentEventController extends Controller
{
    private $request,$rentEventServ;
    public function __construct(Request $request,RentEventService $rentEventServ)
    {
        $this->request=$request;
        $this->rentEventServ=$rentEventServ;
    }



    public function show()
    {
        $rentEventsObj=$this->rentEventServ->getRentEvents();
        return view('rentEvent.rentEventList',['rentEvents'=>$rentEventsObj]);
    }


    public function addDialog()
    {
        return view('dialog.RentEvent.addRentEvent');
    }

    public function add()
    {
        $this->rentEventServ->addRentEvent();
        return  redirect()->back();
    }


    public function editDialog()
    {
        $event=$this->request->validate(['eventId'=>'required']);
        $rentEventObj=$this->rentEventServ->getRentEvent($event['eventId']);
        return view('dialog.RentEvent.editRentEvent',['rentEventObj'=>$rentEventObj]);
    }


    public function update()
    {

    }

}
