<?php

namespace App\Repositories;
use App\Models\rentEventCrash;
use App\Repositories\Interfaces\EventCrashRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventCrashRepository implements EventCrashRepositoryInterface
{
public function getEventCrash($id)
{
    return rentEventCrash::find($id)?? new rentEventCrash;
}

public function addEventCrash(rentEventCrash $eventCrash) :rentEventCrash
{
    $eventCrash->save();
    return $eventCrash;
}


public function getEventCrashByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

    public function getEventCrashes($eventId,CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_crashes','rent_event_crashes.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderBy('time_sheets.dateTime')
            ->get();
        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return  $resultEventsObj;
    }


}

