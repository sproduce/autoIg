<?php

namespace App\Repositories;
use App\Models\timeSheet;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use Illuminate\Support\Facades\DB;


class TimeSheetRepository implements TimeSheetRepositoryInterface
{

    public function getTimeSheets($dateFrom, $dateTo)
    {
        return timeSheet::query()->whereBetween('dateTime',[$dateFrom,$dateTo])->get();
    }
    public function getTimeSheetsArray($dateFrom, $dateTo)
    {
        return DB::table('time_sheets')->leftJoin('rent_events','time_sheets.eventId','=','rent_events.id')->get(['time_sheets.*','rent_events.priority','rent_events.name']);
    }

    public function getCarTimeSheetByDate($carId, $date)
    {
        $finish = date('Y-m-d', strtotime($date . ' +1 day'));

        return timeSheet::query()->
                whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and carId=?',[$date,$finish,$carId])->
                orWhereBetween('dateTime',[$date,$finish])->where('carId','=',$carId)->orderBy('dateTime')->get();
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
        // TODO: Implement updateTimeSheet() method.
    }

}

