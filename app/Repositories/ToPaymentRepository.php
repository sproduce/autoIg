<?php

namespace App\Repositories;

use App\Models\rentPayment;
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
            ->leftjoin('pay_operation_types','pay_operation_types.id','=','rent_events.payOperationTypeId')
            ->select([
                'to_payments.sum as paymentsSum',
                'to_payments.comment as paymentsComment',
                'to_payments.paymentId as paymentsPaymentId',
                'time_sheets.dateTime as sheetsDateTime',
                'rent_events.name as eventsName',
                'rent_events.color as eventsColor',
                'rent_events.action as eventsAction',
                'pay_operation_types.name as operationTypeName',
            ])
            ->whereNull('to_payments.deleted_at')
            ->whereNull('time_sheets.deleted_at')
            ->where('to_payments.contractId','=',$contractId)
            ->orderBy('time_sheets.dateTime')
            ->get();

        $resultCollection->each(function ($item, $key) {
            $item->sheetsDateTime=Carbon::parse($item->sheetsDateTime);
        });

        return $resultCollection;
    }

    public function getToPayment($toPaymentId): toPayment
    {
        return toPayment::find($toPaymentId) ??new toPayment();
    }

    public function getToPaymentByTimeSheet($timeSheetId): toPayment
    {
        $resultObj = toPayment::where('timeSheetId',$timeSheetId)->whereColumn('id','pId')->first();
        return $resultObj ?? new toPayment();
    }


    public function getToPaymentsByDate(CarbonPeriod $datePeriod): Collection
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultCollection = DB::table('to_payments')
            ->join('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
            ->leftJoin('rent_events','rent_events.id','=','time_sheets.eventId')
            ->leftjoin('car_configurations','car_configurations.id','=','time_sheets.carId')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->leftJoin('pay_operation_types','pay_operation_types.id','=','rent_events.payOperationTypeId')
            ->leftJoin('rent_subjects as subjectFrom','subjectFrom.id','=','to_payments.subjectIdFrom')
            ->leftJoin('rent_subjects as subjectTo','subjectTo.id','=','to_payments.subjectIdTo')
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
                'to_payments.contractId as toPaymentContractId',
                'to_payments.comment as toPaymentComment',
                'to_payments.paymentId as paymentId',
                'to_payments.payUp as paymentPayUp',
                'to_payments.paymentSum as paymentSum',

                'rent_contracts.number as contractNumber',

                'pay_operation_types.name as operationTypeName',

                'subjectFrom.nickname as subjectFromNickname',
                'subjectTo.nickname as subjectToNickname',
            ])
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->whereNull('to_payments.deleted_at')
            ->whereNull('time_sheets.deleted_at')
            ->whereRaw('to_payments.id = to_payments.pId')
            ->orderBy('time_sheets.dateTime')
            ->orderBy('to_payments.pid')
            ->get();
        $resultCollection->each(function ($item, $key) {
            if ($item->timeSheetDateTime){
                $item->timeSheetDateTime = Carbon::parse($item->timeSheetDateTime);
                $item->paymentPayUp = Carbon::parse($item->paymentPayUp);
            }

        });
        return $resultCollection;
    }

    public function addToPayment(toPayment $toPaymentObj): toPayment
    {
        $toPaymentObj->save();
        if (is_null($toPaymentObj->pId)){
            $toPaymentObj->pId = $toPaymentObj->id;
            $toPaymentObj->save();
        }

        return $toPaymentObj;
    }


    public function delToPayment(toPayment $toPayment)
    {
        $toPayment->delete();
    }

    public function getToPayments()
    {
        return toPayment::all();
    }

   public function getToPaymentsByContractAndOperationType(rentPayment $rentPayment)
   {

        $paymentId = $rentPayment->id;
        $resultCollection = DB::table('to_payments')
            ->join('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->whereRaw('to_payments.id = to_payments.pId')
            ->where('to_payments.contractId','=',$rentPayment->contractId)
            ->where('rent_events.payOperationTypeId','=',$rentPayment->payOperationTypeId)
            ->whereNull('to_payments.deleted_at')
            ->whereNull('time_sheets.deleted_at')
            ->where(function($query) use ($paymentId){
                $query->where('to_payments.paymentId','=',$paymentId);
                $query->orWhereNull('to_payments.paymentId');
            })

            ->select('to_payments.*','rent_events.name','time_sheets.dateTime')
            ->orderBy('dateTime')
            ->orderBy('id')
            ->get();

//        echo DB::table('to_payments')
//            ->join('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
//            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
//            ->whereRaw('to_payments.id = to_payments.pId')
//            ->where('to_payments.contractId','=',$rentPayment->contractId)
//            ->where('rent_events.payOperationTypeId','=',$rentPayment->payOperationTypeId)
//            ->where(function($query) use ($paymentId){
//                $query->where('to_payments.paymentId','=',$paymentId);
//                $query->orWhereNull('to_payments.paymentId');
//            })
//
//            ->select('to_payments.*','rent_events.name','time_sheets.dateTime')
//            ->orderBy('dateTime')
//            ->orderBy('id')
//            ->toSql();

       //$resultCollection->dd();
       $resultCollection->each(function ($item, $key) {
           if ($item->dateTime) {
               $item->dateTime = Carbon::parse($item->dateTime);
           }
       });
       return  $resultCollection;
   }


   public function getToPaymentsByOperationType()
   {
       // TODO: Implement getToPaymentsByOperationType() method.
   }



    public function getAllocateToPaymentSum(rentPayment $paymentObj)
    {
        return toPayment::where('paymentId',$paymentObj->id)->sum('sum');
    }

    public function delAllocateToPayment(rentPayment $paymentObj)
    {
        return toPayment::where('paymentId',$paymentObj->id)->update(['paymentId' => null]);
    }


}

