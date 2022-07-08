<?php

namespace App\Repositories;
use App\Models\rentCarGroup;
use App\Models\rentEventRental;
use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventRentalRepository implements EventRentalRepositoryInterface
{
    public function getEventRental($id): rentEventRental
    {
        return rentEventRental::find($id)?? new rentEventRental;
    }

    public function addEventRental(rentEventRental $rentEventRentalObj): rentEventRental
    {
        $rentEventRentalObj->save();
        return $rentEventRentalObj;
    }


    public function getEventRentalsByContract($contractId)
    {
        // TODO: Implement getEventRentalsByContract() method.
    }

    public function getEventRentals($eventId,CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate  =$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_rentals','rent_event_rentals.id', '=', 'time_sheets.dataId')
            ->leftjoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftjoin('rent_contracts','rent_contracts.id','=','rent_event_rentals.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function getEventRentalFullInfo($eventId,$dataId)
    {

        $resultEventObj = DB::table('time_sheets')
            ->leftjoin('rent_event_rentals','rent_event_rentals.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_rentals.id as id',
                'car_configurations.nickName as carText',
                'car_configurations.id as carId',
                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',
                'to_payments.sum as sum',
                'time_sheets.comment as comment',
                'time_sheets.dateTime as dateTime',
                'time_sheets.duration as duration',
            ])
            ->first();

        $resultEventObj = $resultEventObj ?? new rentEventRental();

        if ($resultEventObj->dateTime){
            $resultEventObj->dateTime =  Carbon::parse($resultEventObj->dateTime);
        }
        return $resultEventObj;
    }


    public function delEvent(rentEventRental $rentEventRental)
    {
        $rentEventRental->delete();
    }
}

