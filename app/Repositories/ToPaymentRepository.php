<?php

namespace App\Repositories;

use App\Models\toPayment;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class ToPaymentRepository implements ToPaymentRepositoryInterface
{

    public function getToPaymentsByContract($contractId)
    {
        return toPayment::query()->where('contractId',$contractId)->get();
    }

    public function getToPayment($toPaymentId)
    {
        return toPayment::find($toPaymentId);
    }


    public function getToPaymentsByDate(CarbonPeriod $datePeriod): Collection
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultCollection= DB::table('to_payments')
            ->join('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
            ->join('car_configurations','car_configurations.id','=','time_sheets.carId')
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->select(['rent_events.*','time_sheets.*','car_configurations.*','to_payments.sum as sumToPay'])
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->get();

        $resultCollection->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return $resultCollection;
    }

    public function addToPayment($toPaymentArray)
    {
        return toPayment::create($toPaymentArray);
    }
    public function updateToPayment($id,$toPaymentArray)
    {
        toPayment::where('id',$id)->update($toPaymentArray);
    }
    public function delToPayment($toPaymentId)
    {
        $toPayment=toPayment::find($toPaymentId);
        $toPayment->delete();
    }

    public function getToPayments()
    {
        return toPayment::all();
    }
}

