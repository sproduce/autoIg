<?php

namespace App\Repositories;

use App\Models\rentEventService;
use App\Repositories\Interfaces\EventServiceRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventServiceRepository implements EventServiceRepositoryInterface
{


    public function addEvent($dataArray)
    {
        // TODO: Implement addEvent() method.
    }

    public function getEventsByContract($contractId)
    {
        // TODO: Implement getEventsByContract() method.
    }

    public function getEvent($id): rentEventService
    {
        return new rentEventService();
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
}

