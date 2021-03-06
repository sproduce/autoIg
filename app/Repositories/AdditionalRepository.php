<?php

namespace App\Repositories;

use App\Models\rentAdditional;

use App\Repositories\Interfaces\AdditionalRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class AdditionalRepository implements AdditionalRepositoryInterface
{


    public function getAdditionals()
    {
        return rentAdditional::all();
    }

    public function getAdditionalsByDate(CarbonPeriod $datePeriod):Collection
    {
        $startDate=$datePeriod->getStartDate()->format('Y-m-d');
        $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

        $additionalsCollection=DB::table('rent_additionals')
            ->join('time_sheets','time_sheets.id','=','rent_additionals.timeSheetId')
            ->join('car_configurations','car_configurations.id','=','time_sheets.carId')
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->select(['rent_events.*','time_sheets.*','car_configurations.*','rent_additionals.sum as sumAdditional'])
            ->whereBetween('dateTime',[$startDate,$finishDate])
            ->get();

        $additionalsCollection->each(function ($item, $key) {
            $item->dateTime=Carbon::parse($item->dateTime);
        });
        return  $additionalsCollection;
    }

    public function getAdditionalFullInfo($additionalId)
    {
        $additionalCollection=DB::table('rent_additionals')
            ->join('time_sheets','time_sheets.id','=','rent_additionals.timeSheetId')
            ->join('car_configurations','car_configurations.id','=','time_sheets.carId')
            ->join('rent_events','rent_events.id','=','time_sheets.eventId')
            ->select([
                'rent_events.id as rentEventId',
                'rent_events.action as rentEventAction',
                'rent_events.name as rentEventName',
                'rent_events.color as rentEventColor',
                'time_sheets.id as timeSheetId',
                'car_configurations.id as carId',
                'car_configurations.nickName as carNickName',
                'rent_additionals.id as additionalId',
                'rent_additionals.sum as additionalSum',
                'rent_additionals.isPay as additionalIsPay',
                ])
            ->where('rent_additionals.id','=',$additionalId)
            ->first();

        return $additionalCollection;
    }


    public function addAdditional($additionalArray)
    {
       return rentAdditional::create($additionalArray);
    }

}

