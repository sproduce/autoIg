<?php

namespace App\Repositories\Interfaces;


use App\Models\carConfiguration;
use App\Models\rentEvent;
use App\Models\timeSheet;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;

interface TimeSheetRepositoryInterface
{
    public function getTimeSheets($dateFrom,$dateTo):Collection;

    public function getTimeSheetsByEvent($eventId,CarbonPeriod  $datePeriod);
    public function getTimeSheet($timeSheetId):timeSheet;
    public function getTimeSheetsArray($dateFrom,$dateTo);
    public function getTimeSheetByDate($date);
    public function getTimeSheetById($id);
    public function addTimeSheet(timeSheet $timeSheetObj): timeSheet;
    public function updateTimeSheet($id,$dataArray);
    public function getCarTimeSheetByDate($carId,CarbonPeriod  $datePeriod);
    public function getCarSpanTimeSheet($carId,CarbonPeriod  $periodDate);
    public function getContractTimeSheets($contractId);

    public function getTimeSheetByEvent(rentEvent $eventObj,$eventDataId): ?timeSheet;

    public function getTimeSheetPeriod();


    public function getLastTimeSheet(carConfiguration $carObj,rentEvent $eventObj): ?timeSheet;

}
