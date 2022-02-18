<?php

namespace App\Repositories;
use App\Models\timeSheet;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class TimeSheetRepository implements TimeSheetRepositoryInterface
{

    public function getTimeSheets($dateFrom, $dateTo)
    {
        return timeSheet::query()->whereBetween('dateTime',[$dateFrom,$dateTo])->get();
    }

    public function getTimeSheet($timeSheetId)
    {
        return timeSheet::find($timeSheetId);
    }

    public function getTimeSheetsArray($dateFrom, $dateTo)
    {
        return DB::table('time_sheets')->leftJoin('rent_events','time_sheets.eventId','=','rent_events.id')->get(['time_sheets.*','rent_events.priority','rent_events.name']);
    }

    public function getCarTimeSheetByDate($carId, $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return timeSheet::query()->
                whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and carId=?',[$startDate,$finishDate,$carId])->
                orWhereBetween('dateTime',[$startDate,$finishDate])->where('carId','=',$carId)->orderBy('dateTime')->get();
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

    public function addTimeSheet($dataArray)
    {
        return timeSheet::create($dataArray);
    }


    public function updateTimeSheet($id, $dataArray)
    {
        timeSheet::where('id',$id)->update($dataArray);
    }


    public function getCarSpanTimeSheet($carId, CarbonPeriod $periodDate)
    {
        //echo timeSheet::query()->selectRaw('min(dateTime),max(dateTime)') ->groupBy(['eventId','dataId'])->orderBy('dateTime')->toSql();
       return timeSheet::query()->selectRaw('min(dateTime) as fromDate,max(dateTime) as toDate')->groupBy(['eventId','dataId'])->where('carId',$carId)->orderBy('dateTime')->get();
        //select min(dateTime),max(dateTime),eventId,dataId,duration from time_sheets where carId=12 group by eventId,dataId order by dateTime
    }


}

