<?php

namespace App\Repositories;
use App\Models\rentEventCrash;
use App\Repositories\Interfaces\EventCrashRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventCrashRepository implements EventCrashRepositoryInterface
{
public function getEventCrash($id)
{
    return rentEventCrash::find($id)?? new rentEventCrash;
}

public function addEventCrash($dataArray)
{
  return rentEventCrash::create($dataArray);
}


public function getEventCrashByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

    public function getEventCrashes($eventId,CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return DB::table('time_sheets')
            ->join('rent_event_crashes','rent_event_crashes.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderBy('time_sheets.dateTime')
            ->get();
    }


}

