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
            ->leftJoin('rent_additionals','rent_additionals.toPaymentsId','=','to_payments.id')
            ->select([
                'rent_events.name as eventName',
                'rent_events.action as eventAction',
                'rent_events.id as eventId',
                'time_sheets.id as timeSheetId',
                'time_sheets.dateTime as timeSheetDateTime',
                'time_sheets.dataId as timeSheetDataId',
                'car_configurations.nickName as carNickName',
                'car_configurations.id as carId',
                'to_payments.sum as toPaymentSum',
                'to_payments.id as toPaymentId',
                'rent_additionals.id as rentAdditionalId',
            ])
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->get();
        //$resultCollection->dump();
        $resultCollection->each(function ($item, $key) {
            $item->timeSheetDateTime=Carbon::parse($item->timeSheetDateTime);
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

