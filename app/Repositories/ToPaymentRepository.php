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

    public function getToPaymentsByContract($contractId): Collection
    {
        $resultCollection = DB::table('to_payments')
            ->leftjoin('time_sheets','time_sheets.id', '=' ,'to_payments.timeSheetId')
            ->leftjoin('rent_events','rent_events.id','=','time_sheets.eventId')
            ->select([
                'to_payments.sum as paymentsSum',
                'to_payments.comment as paymentsComment',
                'to_payments.paymentId as paymentsPaymentId',
                'time_sheets.dateTime as sheetsDateTime',
                'rent_events.name as eventsName',
                'rent_events.color as eventsColor',
                'rent_events.action as eventsAction',
            ])
            ->where('to_payments.contractId','=',$contractId)
            ->orderBy('time_sheets.dateTime')
            ->get();

        $resultCollection->each(function ($item, $key) {
            $item->sheetsDateTime=Carbon::parse($item->sheetsDateTime);
        });

        return $resultCollection;
    }

    public function getToPayment($toPaymentId)
    {
        return toPayment::find($toPaymentId);
    }


    public function getToPaymentsByDate(CarbonPeriod $datePeriod): Collection
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultCollection = DB::table('to_payments')
            ->leftjoin('car_configurations','car_configurations.id','=','to_payments.carId')
            ->leftJoin('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
            ->leftJoin('rent_events','rent_events.id','=','time_sheets.eventId')


            //->leftJoin('to_payments as tp','to_payments.id','=','tp.pId')
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
                'to_payments.comment as toPaymentComment',
                'to_payments.paymentId as paymentId',
                //'tp.id as toPaymentChild',
            ])
            //->whereBetween('dateTime',[$startDate,$finishDate])
            ->orderBy('time_sheets.dateTime')
            ->get();
        //$resultCollection->dump();
        $resultCollection->each(function ($item, $key) {
            if ($item->timeSheetDateTime){
                $item->timeSheetDateTime=Carbon::parse($item->timeSheetDateTime);
            }

        });
        return $resultCollection;
    }

    public function addToPayment(toPayment $toPaymentObj): toPayment
    {
        $toPaymentObj->save();
        return $toPaymentObj;
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

    public function getToPaymentsByOperationType()
    {
        // TODO: Implement getToPaymentsByOperationType() method.
    }


}

