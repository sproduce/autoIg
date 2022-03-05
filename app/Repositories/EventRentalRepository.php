<?php

namespace App\Repositories;
use App\Models\rentEventRental;
use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventRentalRepository implements EventRentalRepositoryInterface
{
public function getEventRental($id)
{
    return rentEventRental::find($id)?? new rentEventRental;
}

public function addEventRental($dataArray)
{
  return rentEventRental::create($dataArray);
}
public function getEventRentalsByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

    public function getEventRentals($eventId,CarbonPeriod $datePeriod)
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return DB::table('time_sheets')
            ->join('rent_event_rentals','rent_event_rentals.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('rent_contracts','rent_contracts.id', '=', 'time_sheets.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderBy('time_sheets.dateTime')
            ->get();
    }


}

