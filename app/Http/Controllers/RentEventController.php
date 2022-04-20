<?php

namespace App\Http\Controllers;

use App\Repositories\PaymentRepository;
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
        $validate=$this->request->validate(['name'=>'required',
            'color'=>'required',
            'action'=>'required'
        ]);

        $this->rentEventServ->addRentEvent($validate);
        return  redirect()->back();
    }


    public function editDialog(PaymentRepository $paymentRep)
    {
        $event=$this->request->validate(['eventId'=>'required']);
        $rentEventObj=$this->rentEventServ->getRentEvent($event['eventId']);
        $paymentTypes=$paymentRep->getOperationTypes();
        return view('dialog.RentEvent.editRentEvent',['rentEventObj' => $rentEventObj,
            'paymentTypes' => $paymentTypes]);
    }


    public function update()
    {
        $eventArray=$this->request->validate(['id' => 'required',
            'name' => '',
            'color' => '',
            'action' =>'',
            'priority' => 'nullable|integer',
            'duration' => 'nullable|integer',
            'isToPay' => 'nullable',
            'payOperationTypeId' => 'integer'
            ]);
        $this->rentEventServ->updateRentEvent($eventArray);

        return  redirect()->back();
    }

}
