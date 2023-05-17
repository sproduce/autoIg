<?php
namespace App\Services;


use Carbon\CarbonPeriod;

use App\Services\TimeSheetService;
use \PhpOffice\PhpSpreadsheet\Spreadsheet;


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
                    foreach ($car->filterTimeSheets as $timeSheet){
                        $car->toPay += $timeSheet->toPayment->sum;
                        $car->pay += $timeSheet->toPayment->paymentSum;
                        //$car->toPay += $timeSheet->toPayment->sum;
                        //$timeSheet->eventData = $eventServ->getEventModel($timeSheet->dataId);
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
    
    
    
    
    
    public function generateExcelFile(Spreadsheet $spreadsheet,$carGroups) 
    {
        //$spreadsheet->setCellValue();
        $sheet = $spreadsheet->getSheet(0)->setTitle('testTtile');
        $line = 1;
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(10);
        $sheet->getColumnDimension('E')->setWidth(10);
        $sheet->getColumnDimension('F')->setWidth(10);
        $sheet->getColumnDimension('G')->setWidth(12);
//        $sheet->getColumnDimension('H')->setWidth(10);
        
        foreach ($carGroups as $carGroup){
            if (count($carGroup->carsModel)){
                $cell = $sheet->getCell("A{$line}");
                $cell->setValue($carGroup->name);
                $line++;
                foreach($carGroup->carsModel as $car){
                    $cell = $sheet->getCell("B{$line}");
                    $cell->setValue($car->nickName);
                    $line++;
                    $cell = $sheet->getCell("C{$line}");
                    $cell->setValue($car->filterStartText.' - '.$car->filterFinishText);
                    $line++;
                    foreach ($car->filterTimeSheets as $timeSheet){
                        $cell = $sheet->getCell("D{$line}");
                        $cell->setValue($timeSheet->event->name);
                        
                        $cell = $sheet->getCell("E{$line}");
                        $cell->setValue($timeSheet->toPayment->sum);
                        
                        $cell = $sheet->getCell("F{$line}");
                        $cell->setValue($timeSheet->toPayment->paymentSum);
                        
                        $cell = $sheet->getCell("G{$line}");
                        $cell->setValue($timeSheet->dateText);
                        $line++;
                    }
                    $cell = $sheet->getCell("E{$line}");
                    $cell->setValue($car->toPay);
                    $cell = $sheet->getCell("F{$line}");
                    $cell->setValue($car->pay);
                    $line++;
                }
                
                
                
            }
            
        }
        
        return $spreadsheet;
    }
    
    
    
    
}
