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
                'to_payments.paymentSum as paymentsPaymentSum',
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
            $item->sheetsDateTime = Carbon::parse($item->sheetsDateTime);
        });

        return $resultCollection;
    }



    public function getToPaymentsParentByContract($contractId): Collection
    {
        $resultCollection = DB::table('to_payments')
            ->leftjoin('time_sheets','time_sheets.id', '=' ,'to_payments.timeSheetId')
            ->leftjoin('rent_events','rent_events.id','=','time_sheets.eventId')
            ->leftjoin('pay_operation_types','pay_operation_types.id','=','rent_events.payOperationTypeId')
            ->select([
                'to_payments.sum as paymentsSum',
                'to_payments.id as paymentsId',
                'to_payments.paymentSum as paymentsPaymentSum',
                'to_payments.comment as paymentsComment',
                'to_payments.paymentId as paymentsPaymentId',
                'time_sheets.dateTime as sheetsDateTime',
                
                'rent_events.id as eventsId',
                'rent_events.name as eventsName',
                'rent_events.color as eventsColor',
                'rent_events.colorPartPay as eventsColorPartPay',
                'rent_events.colorPay as eventsColorPay',

                'rent_events.action as eventsAction',
                'pay_operation_types.name as operationTypeName',
            ])
            ->whereNull('to_payments.deleted_at')
            ->whereNull('time_sheets.deleted_at')
            ->where('to_payments.contractId','=',$contractId)
            ->whereRaw('to_payments.id=to_payments.pId')
            ->orderBy('time_sheets.dateTime')
            ->get();

        $resultCollection->each(function ($item, $key) {
            $item->sheetsDateTime = Carbon::parse($item->sheetsDateTime);
        });

        return $resultCollection;
    }




    public function getToPayment($toPaymentId): toPayment
    {
        return toPayment::find($toPaymentId) ?? new toPayment();
    }

    public function getToPaymentByTimeSheet($timeSheetId): toPayment
    {
        $resultObj = toPayment::where('timeSheetId',$timeSheetId)->whereColumn('id','pId')->first();
        return $resultObj ?? new toPayment();
    }


    public function getToPayments($filtersValue,CarbonPeriod $datePeriod): Collection
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultQuery = DB::table('to_payments')
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
                'rent_events.color as eventColor',
                'rent_events.color as color',
                'rent_events.colorPartPay as colorPartPay',
                'rent_events.colorPay as colorPay',
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
            ->whereRaw('to_payments.id = to_payments.pId');

        if ($filtersValue['carId']){
            $resultQuery->where('car_configurations.id','=',$filtersValue['carId']);
        }
        if ($filtersValue['eventId']){
            $resultQuery->where('rent_events.id','=',$filtersValue['eventId']);
        }
        if ($filtersValue['subjectFromId']){
            $resultQuery->where('subjectFrom.id','=',$filtersValue['subjectFromId']);
        }
        if ($filtersValue['subjectToId']){
            $resultQuery->where('subjectTo.id','=',$filtersValue['subjectToId']);
        }


        $resultCollection =  $resultQuery->orderBy('time_sheets.dateTime')
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
        $toPayment->forceDelete();
    }


   public function getToPaymentsByAllocatePayment(rentPayment $rentPayment)
   {

        $paymentId = $rentPayment->id;
        $resultCollectionRequest = DB::table('to_payments')
            ->join('time_sheets','time_sheets.id','=','to_payments.timeSheetId')
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->leftJoin('pay_operation_types','pay_operation_types.id','=','rent_events.payOperationTypeId')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->whereRaw('to_payments.id = to_payments.pId')
            ->whereRaw('to_payments.sum <> to_payments.paymentSum')
            ->where('to_payments.sum','<>',0);

        if ($rentPayment->contractId){
            $resultCollectionRequest->where('to_payments.contractId','=',$rentPayment->contractId);
        }

        if ($rentPayment->payOperationTypeId){
           $resultCollectionRequest->where('rent_events.payOperationTypeId','=',$rentPayment->payOperationTypeId);
        }

        if ($rentPayment->carId){
            $carId = $rentPayment->carId;
            $resultCollectionRequest->where(function($query) use ($carId){

             $query->whereRaw('to_payments.contractId = rent_contracts.id')
                ->where('rent_contracts.carId','=',$carId)
                ->orWhere('time_sheets.carId','=',$carId);
            });
            
        }

        if ($rentPayment->subjectId){
            $subjectId = $rentPayment->subjectId;
            $resultCollectionRequest = $resultCollectionRequest->where(function($query) use ($subjectId){

                $query->where('to_payments.subjectIdFrom','=',$subjectId)->orWhere('to_payments.subjectIdTo','=',$subjectId);


            });

        }

       $resultCollectionRequest->whereNull('to_payments.deleted_at')
            ->whereNull('time_sheets.deleted_at')
            ->where(function($query) use ($paymentId){
                $query->where('to_payments.paymentId','=',$paymentId);
                $query->orWhereNull('to_payments.paymentId');
            })
            ->orWhere('to_payments.paymentId','=',$rentPayment->id)
            ->select('to_payments.*',
                'rent_events.name',
                'rent_events.color as color',
                'pay_operation_types.name as operationName',
                'time_sheets.dateTime',
                'time_sheets.eventId',
                'time_sheets.dataId',
                'time_sheets.uuid as uuid',
                'time_sheets.id as timeSheetId',
                    'to_payments.sum as toPaymentSum',
                    'to_payments.paymentSum as toPaymentPaymentSum',
                'rent_contracts.number as contractNumber')
            ->orderBy('dateTime')
            ->orderBy('id');
 
//            echo  $resultCollectionRequest->toSql();
//            exit();
       $resultCollection = $resultCollectionRequest->get();

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


    public function delChildToPayment(toPayment $toPayment)
    {
        toPayment::where('pId',$toPayment->id)
            ->whereColumn('id','!=','pId')
            ->delete();
    }



    public function getToPaymentsParentByPayment(rentPayment $paymentObj)
    {
        $result = toPayment::whereColumn('id','pId')->where('paymentId',$paymentObj->id)->get();
        return $result;
    }


    public function getToPaymentsByPayment(rentPayment $paymentObj)
    {
        $result = toPayment::where('paymentId',$paymentObj->id)->get();
        return $result;
    }


    public function getToPaymentChilds($toPaymentId)
    {
        $result = toPayment::where('pId',$toPaymentId)->whereColumn('id','<>','pId')->get();
        return $result;
    }


}

