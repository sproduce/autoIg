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
    
    private $eventObj;
    function __construct(
            \App\Models\rentEvent $eventObj
        ){
        $this->eventObj = $eventObj;
    }
    
    
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
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_rentals','rent_event_rentals.id', '=', 'time_sheets.dataId')
            ->leftjoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftjoin('rent_contracts','rent_contracts.id','=','rent_event_rentals.contractId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->whereNull('time_sheets.deleted_at')
            ->orderByDesc('time_sheets.dateTime')
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
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ])
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
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
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
    
    
    public function getNearestEvent(Carbon $dateTime,$carId=null)
    {
        //SELECT * FROM `time_sheets` WHERE carId=29 and eventId=2 and dateTime<'2022-03-30 18:00' order by dateTime desc limit 1
        $requestEventObj = DB::table('time_sheets')
                ->join('rent_event_rentals','rent_event_rentals.id','=','time_sheets.dataId')
                ->where('time_sheets.eventId','=',$this->eventObj->id)
                ->where('time_sheets.carId','=',$carId)
                ->where('time_sheets.dateTime','<=',$dateTime->toDateTimeString())
                ->whereNull('rent_event_rentals.deleted_at')
                ->orderByDesc('time_sheets.dateTime')
                ->select([
                    'time_sheets.dateTime as dateTime',
                    'time_sheets.duration as duration',
                    'time_sheets.carId as carId',
                    'rent_event_rentals.contractId as contractId',
                    'rent_event_rentals.id as id',
                ])->take(1);
        $resultEventObj = $requestEventObj->first();
        
        if ($resultEventObj){
            $resultEventObj->dateTime =  Carbon::parse($resultEventObj->dateTime);
        }
        return $resultEventObj;
    }
    
    
    
}

