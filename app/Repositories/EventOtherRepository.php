<?php

namespace App\Repositories;
use App\Models\rentEventOther;
use App\Repositories\Interfaces\EventOtherRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventOtherRepository implements EventOtherRepositoryInterface
{


    public function addEvent($dataArray)
    {
        // TODO: Implement addEvent() method.
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id): rentEventOther
    {
        return rentEventOther::find($id) ?? new rentEventOther();
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function getEventFullInfo($eventId,$dataId)
    {

        $resultEventObj = DB::table('time_sheets')
            ->leftjoin('rent_event_others','rent_event_others.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_others.id as idOther',
                'car_configurations.nickName as catTextOther',
                'car_configurations.id as carIdOther',
                'rent_contracts.id as contractIdOther',
                'rent_contracts.number as contractNumberOther',
                'to_payments.sum as sumOther',
                'rent_event_others.comment as commentOther',
                'time_sheets.dateTime as dateTimeOther',
            ])
            ->first();



        return $resultEventObj;
    }

}

