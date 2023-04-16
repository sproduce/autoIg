<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentEventService;
use App\Http\Requests\DateSpan;





class ReportController extends Controller
{
    private $rentEventServ,$request;
    
    
    public function __construct(
        Request $request,
        RentEventService $rentEventServ
    ){
        $this->request = $request;
        $this->rentEventServ = $rentEventServ;
    }

    
    public function list(DateSpan $dateSpan) 
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        $eventsObj = $this->rentEventServ->getEvents();
        
        
         return view('report.list',['periodDate' => $periodDate,
             'eventsObj' => $eventsObj,
             ]);
    }
    
    
    
}
