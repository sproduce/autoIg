<?php
namespace App\Services;


use Carbon\CarbonPeriod;

use App\Services\TimeSheetService;



Class ReportService {
    private $timeSheetServ;

    function __construct(
            TimeSheetService$timeSheetServ
    ){
        $this->timeSheetServ = $timeSheetServ;
    }


    public function getTimeSheetsObj(CarbonPeriod $datePeriod, $eventsId) 
    {
        
    }
    
    
}
