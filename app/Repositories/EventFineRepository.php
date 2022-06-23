<?php

namespace App\Repositories;
use App\Models\rentEventFine;
use App\Repositories\Interfaces\EventFineRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class EventFineRepository implements EventFineRepositoryInterface
{
public function getEventFine($id): rentEventFine
{
    return rentEventFine::find($id)?? new rentEventFine;
}

public function addEventFine($dataArray)
{
  return rentEventFine::create($dataArray);
}
public function getEventFinesByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

    public function getEventFines($eventId,CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_fines','rent_event_fines.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();


        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function delEventFine(rentEventFine $eventFineObj)
    {
        $eventFineObj->delete();
    }

}

