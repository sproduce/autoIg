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

    public function getEventFullInfo($eventId, $dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->join('rent_event_document_titles','rent_event_document_titles.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_document_titles.id as id',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',

                'to_payments.sum as sumPayment',
                'time_sheets.dateTime as date',
                'time_sheets.comment as comment',
                'time_sheets.pId as parentId',
            ])
            ->first();
        $resultEventObj =  $resultEventObj ?? new rentEventDocumentTitle();
      
        //$resultEventObj->date = Carbon::parse($resultEventObj->date);


        return $resultEventObj;
    }

    public function getEvents($eventId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $resultEventsObj = DB::table('time_sheets')
            ->where('time_sheets.eventId','=',$eventId)
            ->whereNull('deleted_at')
            //->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orderByDesc('time_sheets.dateTime')
            ->get();

        $resultEventsObj->each(function ($item, $key) {
            $item->dateTime = Carbon::parse($item->dateTime);
        });

        return $resultEventsObj;
    }


    public function delEvent(rentEventDocumentTitle $rentEventDocumentTitle)
    {
        // TODO: Implement delEvent() method.
    }


}

