<?php

namespace App\Http\Controllers;

use App\Models\rentEventService;
use App\Repositories\RentEventRepository;
use Illuminate\Http\Request;

class EventServiceController extends Controller
{

    protected $rentEventRep,$request,$eventObj;

    public function __construct(RentEventRepository $rentEventRep)
    {
        $this->rentEventRep = $rentEventRep;
        $rc= new \ReflectionClass($this);
        $eventObj=$rentEventRep->getEventByAction($rc->getShortName());
        $this->eventObj=$eventObj;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rentEvent.listEventsService',['eventsObj' => $eventsObj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rentEventService  $rentEventService
     * @return \Illuminate\Http\Response
     */
    public function show(rentEventService $rentEventService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rentEventService  $rentEventService
     * @return \Illuminate\Http\Response
     */
    public function edit(rentEventService $rentEventService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rentEventService  $rentEventService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rentEventService $rentEventService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rentEventService  $rentEventService
     * @return \Illuminate\Http\Response
     */
    public function destroy(rentEventService $rentEventService)
    {
        //
    }
}