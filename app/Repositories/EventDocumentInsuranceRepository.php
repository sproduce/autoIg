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
        // TODO: Implement getEvents() method.
    }
    public function getEventFullInfo($eventId, $dataId)
    {
        $resultEventObj = DB::table('time_sheets')
            ->join('rent_event_document_insurances','rent_event_document_insurances.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId)
            ->select([
                'rent_event_document_insurances.id as id',
                'rent_event_document_insurances.number as number',
                'rent_event_document_insurances.expiration as expiration',

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
        $resultEventObj =  $resultEventObj ?? new rentEventDocumentInsurance();

        $resultEventObj->date = Carbon::parse($resultEventObj->date);
        $resultEventObj->expiration = Carbon::parse($resultEventObj->expiration);

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

