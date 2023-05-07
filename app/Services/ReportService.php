<?php
namespace App\Services;


use Carbon\CarbonPeriod;

use App\Services\TimeSheetService;



Class ReportService {
    private $timeSheetServ;
    private $carGroupServ;
    private $rentEventServ;

    function __construct(
            TimeSheetService$timeSheetServ,
            CarGroupService $carGroupServ,
            RentEventService $rentEventServ
    ){
        $this->timeSheetServ = $timeSheetServ;
        $this->carGroupServ = $carGroupServ;
        $this->rentEventServ = $rentEventServ;
    }


    public function getTimeSheetsObj(CarbonPeriod $datePeriod, $eventsId) 
    {
        
    }
    
    
    public function getFilterGroups(CarbonPeriod $datePeriod) 
    {
        $carGroups = $this->carGroupServ->getCarGroups();
        
        foreach($carGroups as $carGroup){
            $tmpCars = [];
            foreach($carGroup->cars as $car){
                if (($datePeriod->first()<$car->pivot->finish || is_null($car->pivot->finish)) && $datePeriod->last()>$car->pivot->start){
                    
                    if ($car->pivot->start > $datePeriod->first()){
                        $car->filterStartText = $car->pivot->startText;
                        $car->filterStart = $car->pivot->start;
                    } else {
                        $car->filterStartText = $datePeriod->first()->format('d-m-Y');
                        $car->filterStart = $datePeriod->first();
                    }
                    
                    if (is_null($car->pivot->finish) || $car->pivot->finish > $datePeriod->last()){
                        $car->filterFinishText = $datePeriod->last()->format('d-m-Y');
                        $car->filterFinish = $datePeriod->last();
                    } else {
                        $car->filterFinishText =  $car->pivot->finishText;
                        $car->filterFinish =  $car->pivot->finish;
                    }
                    $car->filterTimeSheets = $car->timeSheets->whereBetween('dateTime',[$car->filterStart,$car->filterFinish])->sortBy('dateTime');
//                    foreach ($car->filterTimeSheets as $timeSheet){
//                        $eventServ = $this->rentEventServ->getEventService($timeSheet->event);
//                        $timeSheet->eventData = $eventServ->getEventModel($timeSheet->dataId);
//                    }
                    
                    
                    
                    $tmpCars[] = $car;
                }
            }
            $carGroup->carsModel = $tmpCars;
        }
        //$carGroups->dd();
     //   var_dump($result);
        //exit();
            
        return $carGroups;
    }
    
    
    
    
    
    
    
}
