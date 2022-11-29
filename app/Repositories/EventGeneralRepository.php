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
            ->join('rent_event_generals','rent_event_generals.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereNull('rent_event_generals.deleted_at')
            //->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->select([
                'rent_event_generals.id as id',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',

                'to_payments.sum as sumPayment',

                'time_sheets.dateTime as dateTime',
                'time_sheets.comment as commentSheet',
                'time_sheets.uuid as uuid',
            ])
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function getEventFullInfo($eventId,$dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->join('rent_event_generals','rent_event_generals.id','=','time_sheets.dataId')
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
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ])
            ->first();

        $resultEventObj = $resultEventObj ?? new rentEventGeneral();
        if ($resultEventObj->dateTime){
            $resultEventObj->dateTime = Carbon::parse($resultEventObj->dateTime);
        }

        return $resultEventObj;
    }



    public function delEvent(rentEventGeneral $rentEventGeneral)
    {
        $rentEventGeneral->delete();
    }

}

