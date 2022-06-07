<?php

namespace App\Http\Controllers;

use App\Models\rentEventWash;
use App\Repositories\RentEventRepository;
use Illuminate\Http\Request;

class EventWashController extends Controller
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
        return view('rentEvent.listEventsWash',['eventsObj' => $eventsObj]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
     * @param  \App\Models\rentEventWash  $rentEventWash
     * @return \Illuminate\Http\Response
     */
    public function show(rentEventWash $rentEventWash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rentEventWash  $rentEventWash
     * @return \Illuminate\Http\Response
     */
    public function edit(rentEventWash $rentEventWash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rentEventWash  $rentEventWash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rentEventWash $rentEventWash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rentEventWash  $rentEventWash
     * @return \Illuminate\Http\Response
     */
    public function destroy(rentEventWash $rentEventWash)
    {
        //
    }
}