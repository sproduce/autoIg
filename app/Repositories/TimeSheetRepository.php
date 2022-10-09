<?php

namespace App\Repositories;

use App\Models\carConfiguration;
use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Filters;

class TimeSheetRepository implements TimeSheetRepositoryInterface
{

    public function getTimeSheets($dateFrom, $dateTo): Collection
    {
        return timeSheet::query()->whereBetween('dateTime',[$dateFrom,$dateTo])->get();
    }

    public function getTimeSheet($timeSheetId): timeSheet
    {
        return timeSheet::find($timeSheetId) ?? new timeSheet();
    }

    public function getTimeSheetsArray(CarbonPeriod $datePeriod,Filters\EventListRequest $eventListRequest=null)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d H:i');
        $finishDate = $datePeriod->getEndDate()->subMinute(1)->format('Y-m-d H:i');

        $resultCollection = DB::table('time_sheets')
            ->join('rent_events','time_sheets.eventId','=','rent_events.id')
            ->leftJoin('car_configurations','time_sheets.carId','=','car_configurations.id')
            ->leftJoin('to_payments',function($join){
                $join->on('to_payments.timeSheetId','=','time_sheets.id');
                $join->on('to_payments.id','=','to_payments.pId');
            })
            ->WhereBetween('dateTime',[$startDate,$finishDate])
            ->whereNull('time_sheets.deleted_at')
            ->orderByDesc('time_sheets.dateTime');

        if ($eventListRequest->get('carId')){
            $resultCollection =  $resultCollection->whereIn('car_configurations.id',$eventListRequest->get('carId'));
        }

        if ($eventListRequest->get('eventId')){
            $resultCollection =  $resultCollection->whereIn('rent_events.id',$eventListRequest->get('eventId'));
        }

        $resultCollection = $resultCollection->get([
                'time_sheets.*',
                'to_payments.sum as toPaymentSum',
                'to_payments.paymentSum as toPaymentPaymentSum',
                'rent_events.priority as eventPriority',
                'rent_events.name as eventName',
                'rent_events.color as eventColor',
                'rent_events.colorPartPay as eventColorPartPay',
                'rent_events.colorPay as eventColorPay',
                'car_configurations.nickName as carNickName',
                'car_configurations.id as carId',
            ]);

          $resultCollection->each(function ($item, $key) {
              if ($item->dateTime){
                  $item->dateTime = Carbon::parse($item->dateTime);
              }
          });

          return $resultCollection;
    }

    public function getCarTimeSheetByDate($carId,CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d H:i');
        $finishDate = $datePeriod->getEndDate()->subMinute(1)->format('Y-m-d H:i');
        return timeSheet::query()
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and carId=?',[$startDate,$finishDate,$carId])
            ->orWhereBetween('dateTime',[$startDate,$finishDate])
            ->where('carId','=',$carId)
            ->whereNull('time_sheets.deleted_at')
            ->orderBy('dateTime')
            ->get();
    }


    public function getCarFullInfoByDay($carId, CarbonPeriod $timeSheetDate)
    {
        $startDate = $timeSheetDate->getStartDate()->format('Y-m-d H:i');
        $finishDate = $timeSheetDate->getEndDate()->format('Y-m-d H:i');

        $searchTimeSheet = DB::table('time_sheets')
            ->whereNull('time_sheets.deleted_at')
            ->where('time_sheets.carId','=',$carId)
//            ->orWhereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? a',[$startDate,$finishDate,$carId])
//            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->where(function($query) use ($startDate, $finishDate){
                $query->whereBetween('time_sheets.dateTime',[$startDate,$finishDate]);
                $query->orWhereRaw('DATE_ADD(dateTime,INTERVAL rent_events.duration MINUTE) BETWEEN ? and ?',[$startDate,$finishDate]);
            })
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->leftJoin('to_payments',function($join){
                $join->on('to_payments.timeSheetId','=','time_sheets.id');
                $join->on('to_payments.id','=','to_payments.pId');
            })
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->join('car_configurations','car_configurations.id','=','time_sheets.carId')
            ->select([
                'to_payments.sum as toPaymentSum',
                'to_payments.paymentSum as toPaymentPaymentSum',
                'car_configurations.nickName as carNickName',
                'rent_events.name as eventName',
                'rent_events.color as eventColor',
                'rent_events.colorPartPay as eventColorPartPay',
                'rent_events.colorPay as eventColorPay',
                'rent_contracts.number as contractNumber',
                'rent_contracts.id as contractId',
                'time_sheets.dateTime as timeSheetDateTime',
                'time_sheets.id as timeSheetId',
                ])
        ;
        $searchResult = $searchTimeSheet->get();

        $searchResult->each(function ($item, $key) {
                $item->timeSheetDateTime = Carbon::parse($item->timeSheetDateTime);
        });


        return $searchResult;

    }




    public function getContractTimeSheets($contractId)
    {
        return timeSheet::query()->where('contractId',$contractId)->get();
    }


    public function getTimeSheetByDate($date)
    {
        // TODO: Implement getTimeSheetByDate() method.
    }

    public function getTimeSheetById($id)
    {
        // TODO: Implement getTimeSheetById() method.
    }

    public function addTimeSheet(timeSheet $timeSheetObj): timeSheet
    {
        $timeSheetObj->save();
        return $timeSheetObj;
    }


    public function updateTimeSheet($id, $dataArray)
    {
        timeSheet::where('id',$id)->update($dataArray);
    }


    public function getCarSpanTimeSheet($carId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d H:i');
        $finishDate = $datePeriod->getEndDate()->subMinute(1)->format('Y-m-d H:i');


//        $resultCollection = DB::table('time_sheets')
//            ->groupBy(['time_sheets.eventId','time_sheets.dataId','rent_events.id'])
//            ->join('rent_events','time_sheets.eventId','=','rent_events.id')
//            ->whereBetween('time_sheets.dateTime',[$startDate,$finishDate])
//
//            ->where('time_sheets.carId',$carId)
//            ->selectRaw('min(time_sheets.dateTime) as fromDate,max(DATE_ADD(time_sheets.dateTime,INTERVAL time_sheets.duration MINUTE)) as toDate,sum(time_sheets.sum)')
//            ->select(['rent_events.*'])
//            ->orderBy('time_sheets.dateTime')
//            ->get();
//        $resultCollection->dd();
//        $resultCollection->each(function ($item, $key) {
//            $item->fromDate = Carbon::parse($item->fromDate);
//            $item->toDate = Carbon::parse($item->toDate);
//        });
        $result = timeSheet::query()
            ->selectRaw('min(dateTime) as fromDate,max(DATE_ADD(dateTime,INTERVAL duration MINUTE)) as toDate,eventId')
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->groupBy(['eventId','dataId'])
            ->where('carId',$carId)
            ->whereNull('time_sheets.deleted_at')
            ->orderBy('dateTime')
            ->get();

       return  $result;
    }





    public function getTimeSheetsByEvent($eventId, CarbonPeriod $datePeriod)
    {
        $startDate = $datePeriod->getStartDate()->format('Y-m-d');
        $finishDate = $datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        return timeSheet::query()
            ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
            ->orWhereBetween('dateTime',[$startDate,$finishDate])
            ->whereNull('time_sheets.deleted_at')
            ->where('eventId','=',$eventId)
            ->orderBy('dateTime')
            ->get();
    }


    public function getTimeSheetPeriod()
    {
        // TODO: Implement getTimeSheetPeriod() method.
    }


    public function getLastTimeSheet(carConfiguration $carObj, rentEvent $eventObj): timeSheet
    {
        $timeSheetRequest = timeSheet::where('eventId',$eventObj->id)->where('carId',$carObj->id);
        $timeSheetResult = $timeSheetRequest->orderBy('dateTime','DESC')->first();
        return $timeSheetResult ?? new timeSheet();
    }

    public function getLastTimeSheetId($carId, $eventId): timeSheet
    {
        $timeSheetRequest = timeSheet::where('eventId',$eventId)->where('carId',$carId);
        $timeSheetResult = $timeSheetRequest->orderBy('dateTime','DESC')->first();
        return $timeSheetResult ?? new timeSheet();
    }

    public function getTimeSheetByEvent(rentEvent $eventObj, $eventDataId): timeSheet
    {
        $timeSheetResult = timeSheet::where('eventId',$eventObj->id)
            ->where('dataId',$eventDataId)
            ->first();
        return $timeSheetResult ?? new timeSheet();
    }



    public function delTimeSheet(timeSheet $timeSheetObj)
    {
        $timeSheetObj->delete();
    }


    public function getFullINfoByDay(Carbon $timeSheetDate)
    {
        // TODO: Implement getFullINfoByDay() method.
    }

}

