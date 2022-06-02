<?php

namespace App\Repositories;

use App\Models\carConfiguration;
use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;


class TimeSheetRepository implements TimeSheetRepositoryInterface
{

    public function getTimeSheets($dateFrom, $dateTo): Collection
    {
        return timeSheet::query()->whereBetween('dateTime',[$dateFrom,$dateTo])->get();
    }

    public function getTimeSheet($timeSheetId): timeSheet
    {
        return timeSheet::find($timeSheetId);
    }

    public function getTimeSheetsArray($dateFrom, $dateTo)
    {
        return DB::table('time_sheets')
            ->leftJoin('rent_events','time_sheets.eventId','=','rent_events.id')
            ->get(['time_sheets.*','rent_events.priority','rent_events.name']);
    }

    public function getCarTimeSheetByDate($carId,CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d H:i');
        $finishDate = $datePeriod->getEndDate()->subMinute(1)->format('Y-m-d H:i');
        return timeSheet::query()
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and carId=?',[$startDate,$finishDate,$carId])
            ->orWhereBetween('dateTime',[$startDate,$finishDate])
            ->where('carId','=',$carId)
            ->orderBy('dateTime')
            ->get();
    }

    public function getContractTimeSheets($contractId)
    {
        return timeSheet::query()->where('contractId',$contractId)->get();
    }


    public function getTimeSheetByDate($date)
    {
        // TODO: Implement getTimeSheetByDate() method.
    }

    public function getTimeSheetById($id)
    {
        // TODO: Implement getTimeSheetById() method.
    }

    public function addTimeSheet(timeSheet $timeSheetObj): timeSheet
    {
        $timeSheetObj->save();
        return $timeSheetObj;
    }


    public function updateTimeSheet($id, $dataArray)
    {
        timeSheet::where('id',$id)->update($dataArray);
    }


    public function getCarSpanTimeSheet($carId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d H:i');
        $finishDate = $datePeriod->getEndDate()->subMinute(1)->format('Y-m-d H:i');


//        $resultCollection = DB::table('time_sheets')
//            ->groupBy(['time_sheets.eventId','time_sheets.dataId','rent_events.id'])
//            ->join('rent_events','time_sheets.eventId','=','rent_events.id')
//            ->whereBetween('time_sheets.dateTime',[$startDate,$finishDate])
//
//            ->where('time_sheets.carId',$carId)
//            ->selectRaw('min(time_sheets.dateTime) as fromDate,max(DATE_ADD(time_sheets.dateTime,INTERVAL time_sheets.duration MINUTE)) as toDate,sum(time_sheets.sum)')
//            ->select(['rent_events.*'])
//            ->orderBy('time_sheets.dateTime')
//            ->get();
//        $resultCollection->dd();
//        $resultCollection->each(function ($item, $key) {
//            $item->fromDate = Carbon::parse($item->fromDate);
//            $item->toDate = Carbon::parse($item->toDate);
//        });
        $result = timeSheet::query()
            ->selectRaw('min(dateTime) as fromDate,max(DATE_ADD(dateTime,INTERVAL duration MINUTE)) as toDate,eventId')
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->groupBy(['eventId','dataId'])
            ->where('carId',$carId)
            ->orderBy('dateTime')
            ->get();

       return  $result;
    }





    public function getTimeSheetsByEvent($eventId, CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return timeSheet::query()
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orWhereBetween('dateTime',[$startDate,$finishDate])
            ->where('eventId','=',$eventId)
            ->orderBy('dateTime')
            ->get();
    }


    public function getTimeSheetPeriod()
    {
        // TODO: Implement getTimeSheetPeriod() method.
    }


    public function getLastTimeSheet(carConfiguration $carObj, rentEvent $eventObj): ?timeSheet
    {
        $timeSheetResult = timeSheet::where('carId',$carObj->id)
            ->where('eventId',$eventObj->id)
            ->orderBy('dateTime','DESC')
            ->first();
        return $timeSheetResult;
    }



    public function getTimeSheetByEvent(rentEvent $eventObj, $eventDataId): ?timeSheet
    {
        $timeSheetResult = timeSheet::where('eventId',$eventObj->id)
            ->where('dataId',$eventDataId)
            ->first();
        return $timeSheetResult;
    }

}

