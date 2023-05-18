<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RentEventService;
use App\Http\Requests\DateSpan;
use App\Services\TimeSheetService;
use App\Services\CarGroupService;
use App\Services\ReportService;


class ReportController extends Controller
{
    private $reportServ, $rentEventServ, $request, $timeSheetServ;
    
    
    public function __construct(
        RentEventService $rentEventServ,
        TimeSheetService $timeSheetServ,
        ReportService $reportServ,
        Request $request    
    ){
        $this->rentEventServ = $rentEventServ;
        $this->timeSheetServ = $timeSheetServ;
        $this->reportServ = $reportServ;
        $this->request = $request;
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
        
        $carGroups = $this->reportServ->getFilterGroups($periodDate);
        
        
        
        
        if ($this->request->get('download')){
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        
            $spreadsheet = $this->reportServ->generateExcelFile($spreadsheet,$carGroups);
        
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save('/tmp/demo.xlsx');
            return response()->download('/tmp/demo.xlsx');
        }
        
        //$groupsObj = $carGroupServ->getCarGroups();
        
        return view('report.group',['periodDate' => $periodDate,
            'eventsObj' => $eventsObj,
            'carGroups' => $carGroups,
            ]);
    }
    
    
    
    
    
    
    
    
    
    
}
