<?php

namespace App\Repositories;
use App\Models\rentEventPhotocontrol;
use App\Repositories\Interfaces\EventPhotocontrolRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventPhotocontrolRepository implements EventPhotocontrolRepositoryInterface
{
public function getEvent($id)
{
    return rentEventPhotocontrol::find($id)?? new rentEventPhotocontrol;
}

public function addEvent($photocontrolModel)
{
    $photocontrolModel->save();
  return $photocontrolModel;
}
public function getEventPhotocontrolByContract($contractId)
{
    // TODO: Implement getEventRentalsByContract() method.
}

public function getEventPhotocontrols($eventId, CarbonPeriod $datePeriod)
{
    $startDate=$datePeriod->getStartDate()->format('Y-m-d');
    $finishDate=$datePeriod->getEndDate()->addDay(1)->format('Y-m-d');

    return DB::table('time_sheets')
        ->join('rent_event_photocontrols','rent_event_photocontrols.id', '=', 'time_sheets.dataId')
        ->join('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
        ->where('time_sheets.eventId','=',$eventId)
        ->whereRaw('DATE_ADD(dateTime,INTERVAL duration MINUTE) BETWEEN ? and ? and eventId=?',[$startDate,$finishDate,$eventId])
        ->orderBy('time_sheets.dateTime')
        ->get();
}





public function getEventFullInfo($eventId, $dataId)
{
     $resultQueryEventObj = DB::table('time_sheets')
            ->join('rent_event_photocontrols','rent_event_photocontrols.id','=','time_sheets.dataId')
            ->leftJoin('car_configurations','car_configurations.id', '=', 'time_sheets.carId')
            ->leftJoin('rent_subjects','rent_subjects.id', '=', 'rent_event_photocontrols.personId')
            ->leftJoin('to_payments','to_payments.timeSheetId','=','time_sheets.id')
            ->leftJoin('rent_contracts','rent_contracts.id','=','to_payments.contractId')
            ->where('time_sheets.eventId','=',$eventId)
            ->where('time_sheets.dataId','=',$dataId);
     
        
                   
            
            $resultQueryEventObj->select([
                'rent_event_photocontrols.id as id',
                'rent_event_photocontrols.uuid as uuid',
                'rent_event_photocontrols.personId as personId',

                'car_configurations.nickName as carText',
                'car_configurations.id as carId',

                'rent_contracts.id as contractId',
                'rent_contracts.number as contractNumber',
                
                'rent_subjects.id as subjectId',
                'rent_subjects.nickname as subjectNickname',
                
                
                
                'to_payments.sum as sum',
                'time_sheets.dateTime as date',
                'time_sheets.mileage as mileage',
                'time_sheets.comment as comment',
                'time_sheets.pId as parentId',
                'time_sheets.uuid as uuid',
            ]);
        $resultEventObj = $resultQueryEventObj->first();
        
        $resultEventObj =  $resultEventObj ?? new rentEventPhotocontrol();
        
        
        if($resultEventObj->date){
            $resultEventObj->date = Carbon::parse($resultEventObj->date);
        }

        return $resultEventObj;
    
    
    
}



}

