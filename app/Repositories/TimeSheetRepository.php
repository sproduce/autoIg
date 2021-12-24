<?php

namespace App\Repositories;
use App\Models\timeSheet;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;


class TimeSheetRepository implements TimeSheetRepositoryInterface
{

    public function getTimeSheets($dateFrom, $dateTo)
    {
        return timeSheet::query()->whereBetween('dateTime',[$dateFrom,$dateTo])->get();
    }

    public function getCarTimeSheetByDate($carId, $date)
    {
        $finish = date('Y-m-d', strtotime($date . ' +1 day'));

        return timeSheet::query()->whereBetween('dateTime',[$date,$finish])->where('carId','=',$carId)->get();
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

