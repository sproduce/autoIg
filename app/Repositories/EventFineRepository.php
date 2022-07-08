<?php

namespace App\Repositories;
use App\Models\rentEventFine;
use App\Repositories\Interfaces\EventFineRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class EventFineRepository implements EventFineRepositoryInterface
{
    public function getEvent($id): rentEventFine
    {
        return rentEventFine::find($id)?? new rentEventFine;
    }

    public function addEvent(rentEventFine $rentEventFine): rentEventFine
    {
        $rentEventFine->save();
        return $rentEventFine;
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventRentalsByContract() method.
    }

    public function getEvents($eventId,CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_fines','rent_event_fines.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereNull('rent_event_fines.deleted_at')
            //->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();


        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function delEvent(rentEventFine $eventFineObj)
    {
        $eventFineObj->delete();
    }


    public function getEventFullInfo($eventId,$dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->leftjoin('rent_event_fines','rent_event_fines.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_fines.id as id',
                'rent_event_fines.dateTimeOrder as dateTimeOrder',
                'rent_event_fines.dateTimeFine as dateTimeFine',
                'rent_event_fines.datePaySale as datePaySale',
                'rent_event_fines.datePayMax as datePayMax',
                'rent_event_fines.sum as sum',
                'rent_event_fines.sumSale as sumSale',
                'rent_event_fines.uin as uin',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',

                'to_payments.sum as sumPayment',
                'time_sheets.dateTime as dateTimeSheet',
                'time_sheets.comment as commentSheet',
            ])
            ->first();
        $resultEventObj =  $resultEventObj ?? new rentEventFine();
        if($resultEventObj->dateTimeFine){
            $resultEventObj->dateTimeFine =  Carbon::parse($resultEventObj->dateTimeFine);
        }
        if($resultEventObj->dateTimeOrder){
            $resultEventObj->dateTimeOrder =  Carbon::parse($resultEventObj->dateTimeOrder);
        }
        if($resultEventObj->dateTimeSheet){
            $resultEventObj->dateTimeSheet =  Carbon::parse($resultEventObj->dateTimeSheet);
        }

        return $resultEventObj;
    }


}

