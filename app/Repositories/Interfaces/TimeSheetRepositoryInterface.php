<?php

namespace App\Repositories\Interfaces;


use Carbon\CarbonPeriod;

interface TimeSheetRepositoryInterface
{
    public function getTimeSheets($dateFrom,$dateTo);

    public function getTimeSheetsByEvent($eventId,CarbonPeriod  $datePeriod);
    public function getTimeSheet($timeSheetId);
    public function getTimeSheetsArray($dateFrom,$dateTo);
    public function getTimeSheetByDate($date);
    public function getTimeSheetById($id);
    public function addTimeSheet($dataArray);
    public function updateTimeSheet($id,$dataArray);
    public function getCarTimeSheetByDate($carId,CarbonPeriod  $datePeriod);
    public function getCarSpanTimeSheet($carId,CarbonPeriod  $periodDate);
    public function getContractTimeSheets($contractId);
}
