<?php

namespace App\Repositories;

use App\Models\rentEventService;
use App\Repositories\Interfaces\EventServiceRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventServiceRepository implements EventServiceRepositoryInterface
{


    public function addEvent(rentEventService $eventService): rentEventService
    {
        $eventService->save();
        return $eventService;
    }


    public function getEventFullInfo($eventId, $dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->leftjoin('rent_event_services','rent_event_services.id','=','time_sheets.dataId')
            ->leftJoin('rent_subjects','rent_subjects.id', '=', 'rent_event_services.subjectId')
            ->leftJoin('rent_contracts','rent_contracts.id','=','rent_event_services.contractId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')

            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_services.id as id',
                'rent_event_services.comment as comment',
                'car_configurations.nickName as carText',
                'car_configurations.id as carId',
                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',
                'rent_subjects.id as subjectId',
                'rent_subjects.nickname as subjectNickname',
                'to_payments.sum as sum',
                'time_sheets.dateTime as dateTime',
                'time_sheets.mileage as mileage',
            ])
            ->first();

        $resultEventObj = $resultEventObj ? $resultEventObj->dateTime =  Carbon::parse($resultEventObj->dateTime) : new rentEventService();

        return $resultEventObj;
    }


    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id): rentEventService
    {
        return rentEventService::find($id) ??  new rentEventService();
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_services','rent_event_services.id', '=', 'time_sheets.dataId')
            ->leftjoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            //->leftjoin('rent_contracts','rent_contracts.id','=','rent_event_rentals.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(time_sheets.dateTime,INTERVAL time_sheets.duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }

    public function delEvent(rentEventService $eventService)
    {
        $eventService->delete();
    }

}

