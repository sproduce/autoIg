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
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->select([
                'rent_event_crashes.id as id',
                'rent_event_crashes.comment as comment',
                'rent_event_crashes.culprit as culprit',
                'car_configurations.id as carId',
                'car_configurations.nickName as carText',
                'to_payments.sum as sum',
                'time_sheets.dateTime as dateTime',
                'time_sheets.mileage as mileage',
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ])
            ->get();
        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return  $resultEventsObj;
    }

    public function getEventFullInfo($eventId, $dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->join('rent_event_crashes','rent_event_crashes.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_crashes.id as id',
                'rent_event_crashes.comment as comment',
                'rent_event_crashes.culprit as culprit',
                'car_configurations.id as carId',
                'car_configurations.nickName as carText',
                'to_payments.sum as sum',
                'time_sheets.dateTime as dateTime',
                'time_sheets.mileage as mileage',
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ])
            ->first();
        $resultEventObj =  $resultEventObj ?? new rentEventCrash();
        if ($resultEventObj->dateTime){
            $resultEventObj->dateTime =  Carbon::parse($resultEventObj->dateTime);
        }


        return $resultEventObj;
    }


    public function delEvent(rentEventCrash $eventCrash)
    {
        $eventCrash->delete();
    }


}

