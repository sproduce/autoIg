<?php

namespace App\Http\Controllers;

use App\Services\RentEventService;


class RentEventController extends Controller
{
    public function show(RentEventService $rentEventServ)
    {
        $rentEventsObj=$rentEventServ->getRentEvents();
        return view('rentEvent.rentEventList',['rentEvents'=>$rentEventsObj]);
    }


    public function addDialog()
    {
        return view('dialog.RentEvent.addRentEvent');
    }

    public function add(RentEventService $rentEventServ)
    {
        $rentEventServ->addRentEvent();
        return  redirect()->back();
    }


    public function editDialog()
    {

    }


    public function update()
    {

    }

}
