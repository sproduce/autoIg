<?php

namespace App\Repositories;
use App\Models\rentEventTransfer;
use App\Repositories\Interfaces\EventTransferRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventTransferRepository implements EventTransferRepositoryInterface
{
public function getEventTransfer($id)
{
    return rentEventTransfer::find($id)?? new rentEventTransfer;
}

public function addEventTransfer($dataArray)
{
  return rentEventTransfer::create($dataArray);
}
public function getEventTransferByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

public function getEventTransfers($eventId, CarbonPeriod $datePeriod)
{
    $startDate=$datePeriod->getStartDate()->format('Y-m-d');
    $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

    return DB::table('time_sheets')
        ->join('rent_event_transfers','rent_event_transfers.id', '=', 'time_sheets.dataId')
        ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
        ->leftJoin('rent_contracts','rent_contracts.id', '=', 'time_sheets.contractId')
        ->where('time_sheets.eventId','=',$eventId)
        ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
        ->orderBy('time_sheets.dateTime')
        ->get();
}

}

