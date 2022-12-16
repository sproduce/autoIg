<?php

namespace App\Repositories;

use App\Models\rentEventDocumentInsurance;
use App\Repositories\Interfaces\EventDocumentInsuranceRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventDocumentInsuranceRepository implements EventDocumentInsuranceRepositoryInterface
{

    public function getEvent($id): rentEventDocumentInsurance
    {
        return rentEventDocumentInsurance::find($id) ?? new rentEventDocumentInsurance;
    }


    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_document_insurances','rent_event_document_insurances.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereNull('rent_event_document_insurances.deleted_at')
            //->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->select([
                'rent_event_document_insurances.id as id',
                'rent_event_document_insurances.expiration as expiration',
                'rent_event_document_insurances.dateDocument as dateDocument',
                'rent_event_document_insurances.number as number',
                'rent_event_document_insurances.marks as marks',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'to_payments.sum as sumPayment',
                'time_sheets.dateTime as dateTime',
                'time_sheets.comment as commentSheet',
                'time_sheets.uuid as uuid',
            ])
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
            $item->expiration = Carbon::parse($item->expiration);
        });

        return $resultEventsObj;



    }


    public function getEventFullInfo($eventId, $dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->join('rent_event_document_insurances','rent_event_document_insurances.id','=','time_sheets.dataId')
            ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->join('rent_subjects as subject','subject.id','=','rent_event_document_insurances.subject')    
            ->join('rent_subjects as subjectTo','subjectTo.id','=','rent_event_document_insurances.subjectTo')    
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_document_insurances.id as id',
                'rent_event_document_insurances.number as number',
                'rent_event_document_insurances.expiration as expiration',
                'rent_event_document_insurances.dateDocument as dateDocument',
                'rent_event_document_insurances.number as number',
                'rent_event_document_insurances.marks as marks',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',

                'subject.id as subjectId',
                'subject.nickname as subjectNickname',
                
                'subjectTo.id as subjectToId',
                'subjectTo.nickname as subjectToNickname',
                
                
                'to_payments.sum as sum',
                'time_sheets.dateTime as date',
                'time_sheets.comment as comment',
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ])
            ->first();
        $resultEventObj =  $resultEventObj ?? new rentEventDocumentInsurance();

        $resultEventObj->date = Carbon::parse($resultEventObj->date);
        $resultEventObj->expiration = Carbon::parse($resultEventObj->expiration);
        $resultEventObj->dateDocument = Carbon::parse($resultEventObj->dateDocument);

        return $resultEventObj;
    }


    public function addEvent(rentEventDocumentInsurance $rentEventDocumentInsurance): rentEventDocumentInsurance
    {
        $rentEventDocumentInsurance->save();
        return $rentEventDocumentInsurance;
    }

    public function delEvent(rentEventDocumentInsurance $rentEventDocumentInsurance)
    {
        // TODO: Implement delEvent() method.
    }


}

