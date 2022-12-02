<?php

namespace App\Repositories;

use App\Models\rentEventDocumentTitle;
use App\Repositories\Interfaces\EventDocumentTitleRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


class EventDocumentTitleRepository implements EventDocumentTitleRepositoryInterface
{

    public function getEvent($id): rentEventDocumentTitle
    {
        return rentEventDocumentTitle::find($id) ?? new rentEventDocumentTitle();
    }

    public function addEvent(rentEventDocumentTitle $rentEventDocumentTitle): rentEventDocumentTitle
    {
        $rentEventDocumentTitle->save();
        return $rentEventDocumentTitle;
    }

    public function getEventFullInfo($eventId, $filter)
    {
        $resultQueryEventObj = DB::table('time_sheets')
            ->join('rent_event_document_titles','rent_event_document_titles.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('rent_subjects','rent_subjects.id', '=', 'rent_event_document_titles.subjectId')
            ->leftJoin('rent_subjects as ownerSubject','ownerSubject.id', '=', 'rent_event_document_titles.ownerSubjectId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId);
                
            if (isset($filter['dataId'])){
                $resultQueryEventObj->where('time_sheets.dataId','=',$filter['dataId']);
            }
            
            if (isset($filter['number'])){
                $resultQueryEventObj->where('rent_event_document_titles.number','=',$filter['number']);
            }
            
            $resultQueryEventObj->select([
                'rent_event_document_titles.id as id',
                'rent_event_document_titles.regNumber as regNumber',
                'rent_event_document_titles.number as number',
                'rent_event_document_titles.passport as passport',
                'rent_event_document_titles.color as color',
                'rent_event_document_titles.issued as issued',
                'rent_event_document_titles.marks as marks',
                'rent_event_document_titles.dateDocument as dateDocument',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',
                
                'rent_subjects.id as subjectId',
                'rent_subjects.nickname as subjectNickname',
                
                'ownerSubject.id as ownerSubjectId',
                'ownerSubject.nickname as ownerSubjectNickname',
                
                'to_payments.sum as sum',
                'time_sheets.dateTime as date',
                'time_sheets.comment as comment',
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ]);
        $resultEventObj = $resultQueryEventObj->first();
        $resultEventObj =  $resultEventObj ?? new rentEventDocumentTitle();
        
        
        if($resultEventObj->date){
            $resultEventObj->date = Carbon::parse($resultEventObj->date);
        }
        if($resultEventObj->dateDocument){
            $resultEventObj->dateDocument = Carbon::parse($resultEventObj->dateDocument);
        }

        return $resultEventObj;
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->join('rent_event_document_titles','rent_event_document_titles.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereNull('rent_event_document_titles.deleted_at')
            //->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->select([
                'rent_event_document_titles.id as id',
                'rent_event_document_titles.regNumber as regNumber',
                'rent_event_document_titles.number as number',
                'rent_event_document_titles.passport as passport',

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
        });

        return $resultEventsObj;
    }


    public function delEvent(rentEventDocumentTitle $rentEventDocumentTitle)
    {
        $rentEventDocumentTitle->delete();
    }


    
    public function getNumbers($eventId) 
    {
        $query = rentEventDocumentTitle::query()->join('time_sheets','time_sheets.dataId','=','rent_event_document_titles.id')
                ->where('time_sheets.eventId','=',$eventId);
        
        $result = $query->pluck('rent_event_document_titles.number')->toArray();
        return $result;
    }
    
    
    
    
}

