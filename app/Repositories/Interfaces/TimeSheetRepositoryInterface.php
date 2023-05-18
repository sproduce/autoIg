<?php

namespace App\Repositories\Interfaces;


use App\Http\Requests\Filters\EventListRequest;
use App\Models\carConfiguration;
use App\Models\rentEvent;
use App\Models\timeSheet;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\Filters;


interface TimeSheetRepositoryInterface
{
    public function getTimeSheets($dateFrom,$dateTo): Collection;

    public function delTimeSheet(timeSheet $timeSheetObj);

    public function getTimeSheetsByEvent($eventId,CarbonPeriod  $datePeriod);
    public function getTimeSheet($timeSheetId): timeSheet;
    public function getTimeSheetsArray(\Illuminate\Support\Collection $eventListRequest,CarbonPeriod $datePeriod = null);
    public function getTimeSheetByDate($date);
    public function getTimeSheetById($id);

    public function addTimeSheet(timeSheet $timeSheetObj): timeSheet;
    public function updateTimeSheet($id,$dataArray);
    public function getCarTimeSheetByDate($carId,CarbonPeriod  $datePeriod);
    public function getCarSpanTimeSheet($carId,CarbonPeriod  $periodDate);
    public function getContractTimeSheets($contractId);

    public function getTimeSheetByEvent(rentEvent $eventObj,$eventDataId): timeSheet;

    public function getTimeSheetsPeriod(CarbonPeriod $periodDate);

    //public function getAllEvents(CarbonPeriod  $datePeriod);

    public function getLastTimeSheet(carConfiguration $carObj,rentEvent $eventObj): timeSheet;

    public function getLastTimeSheetId($carId,$eventId): timeSheet;

    public function getCarFullInfoByDay($carId,CarbonPeriod $timeSheetDate);

    public function getFullINfoByDay(Carbon $timeSheetDate);

    public function getCarTimeSheets($carId, $eventId = null);
    
    
}
