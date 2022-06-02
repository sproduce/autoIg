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
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return DB::table('time_sheets')
            ->join('rent_event_rentals','rent_event_rentals.id', '=', 'time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderBy('time_sheets.dateTime')
            ->get();
    }


    public function getEventRentalFullInfo($eventId,$eventRentalId)
    {

        $rentalPeriod = DB::table('rent_event_rentals')
               ->join('time_sheets','time_sheets.dataId','=','rent_event_rentals.id')
               ->where('time_sheets.eventId','=',$eventId)
               ->where('time_sheets.dataId','=',$eventRentalId)

               ->selectRaw('MIN(time_sheets.dateTime) as timeSheetMinDateTime')
               ->selectRaw('MAX(DATE_ADD(time_sheets.dateTime,INTERVAL duration MINUTE)) as timeSheetMaxDateTime')
               ->groupBy('time_sheets.dateTime')
               ->first();

    //var_dump($rentalPeriod);
            $rentalPeriod->timeSheetMinDateTime = Carbon::parse($rentalPeriod->timeSheetMinDateTime);
            $rentalPeriod->timeSheetMaxDateTime = Carbon::parse($rentalPeriod->timeSheetMaxDateTime);
            return $rentalPeriod;
    }
}

