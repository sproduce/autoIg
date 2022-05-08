<?php

namespace App\Repositories;
use App\Models\rentEventPhotocontrol;
use App\Repositories\Interfaces\EventPhotocontrolRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventPhotocontrolRepository implements EventPhotocontrolRepositoryInterface
{
public function getEventPhotocontrol($id)
{
    return rentEventPhotocontrol::find($id)?? new rentEventPhotocontrol;
}

public function addEventPhotocontrol($dataArray)
{
  return rentEventPhotocontrol::create($dataArray);
}
public function getEventPhotocontrolByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

public function getEventPhotocontrols($eventId, CarbonPeriod $datePeriod)
{
    $startDate=$datePeriod->getStartDate()->format('Y-m-d');
    $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

    return DB::table('time_sheets')
        ->join('rent_event_photocontrols','rent_event_photocontrols.id', '=', 'time_sheets.dataId')
        ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
        ->where('time_sheets.eventId','=',$eventId)
        ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
        ->orderBy('time_sheets.dateTime')
        ->get();
}


}

