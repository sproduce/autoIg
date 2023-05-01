<?php
namespace App\Services;


use Carbon\CarbonPeriod;

use App\Services\TimeSheetService;



Class ReportService {
    private $timeSheetServ;
    private $carGroupServ;

    function __construct(
            TimeSheetService$timeSheetServ,
            CarGroupService $carGroupServ
    ){
        $this->timeSheetServ = $timeSheetServ;
        $this->carGroupServ = $carGroupServ;
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
                        $car->filterStart = $car->pivot->startText;
                    } else {
                        $car->filterStart = $datePeriod->first()->format('d-m-Y');
                    }
                    
                    if (is_null($car->pivot->finish) || $car->pivot->finish > $datePeriod->last()){
                        $car->filterFinish = $datePeriod->last()->format('d-m-Y');
                    } else {
                        $car->filterFinish =  $car->pivot->finishText;
                    }
                    
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
