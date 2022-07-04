<?php

namespace App\Repositories;
use App\Models\rentEventGeneral;
use App\Repositories\Interfaces\EventGeneralRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventGeneralRepository implements EventGeneralRepositoryInterface
{


    public function addEvent(rentEventGeneral $rentEventGeneral): rentEventGeneral
    {
        $rentEventGeneral->save();
        return $rentEventGeneral;
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id): rentEventGeneral
    {
        return rentEventGeneral::find($id) ?? new rentEventGeneral();
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
            ->leftjoin('rent_event_generals','rent_event_generals.id','=','time_sheets.dataId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_generals.id as id',
                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',
                'to_payments.sum as sum',
                'rent_event_generals.comment as comment',
                'time_sheets.dateTime as dateTime',
            ])
            ->first();

        $resultEventObj = $resultEventObj ? $resultEventObj->dateTimeOther =  Carbon::parse($resultEventObj->dateTimeOther) : new rentEventGeneral();


        return $resultEventObj;
    }

}

