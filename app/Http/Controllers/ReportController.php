<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentEventService;
use App\Http\Requests\DateSpan;
use App\Services\TimeSheetService;
use App\Services\CarGroupService;



class ReportController extends Controller
{
    private $rentEventServ,$request,$timeSheetServ;
    
    
    public function __construct(
        Request $request,
        RentEventService $rentEventServ,
        TimeSheetService $timeSheetServ
    ){
        $this->request = $request;
        $this->rentEventServ = $rentEventServ;
        $this->timeSheetServ = $timeSheetServ;
    }

    
    public function list(DateSpan $dateSpan) 
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        
        $eventsObj = $this->rentEventServ->getEvents();
        
        
        $timeSheets = $this->timeSheetServ->getTimeSheetsObjByPeriod($periodDate);
        
        //$timeSheets->dd();
         return view('report.list',['periodDate' => $periodDate,
             'eventsObj' => $eventsObj,
             'timeSheets' => $timeSheets,
             ]);
    }
    
    
    
    
    
    
    public function group(DateSpan $dateSpan, CarGroupService $carGroupServ) 
    {
        $periodDate = $dateSpan->getCarbonPeriod();
        $eventsObj = $this->rentEventServ->getEvents();
        
        $groupsObj = $carGroupServ->getCarGroups();
        
        
        
        return view('report.group',['periodDate' => $periodDate,
            'eventsObj' => $eventsObj,
            'carGroups' => $groupsObj,
            ]);
    }
    
    
    
    
    
}
