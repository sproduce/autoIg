<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int $carId
 * @property int $eventId
 * @property $dateTime
 * @property string $comment
 * @property int $dataId
 * @property int $mileage
 * @property $color
 * @property int $duration
 * @property int $sum
 * @property int $contractId
 */



class timeSheet extends Model
{
    use HasFactory;
    use SoftDeletes;
    //private $dateTime,$comment,$dataId,$eventId;
    protected $fillable = ['carId', 'eventId','dateTime','comment','mileage','color','duration','dataId'];

    protected $dates = ['dateTime','fromDate','toDate'];

    public function event()
    {
        return $this->hasOne(rentEvent::class,'id','eventId')->withDefault();
    }


    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId')->withDefault();
    }


    public function toPayment()
    {
        return $this->hasOne(toPayment::class,'timeSheetId','id')->whereColumn('id','pId');
    }


    protected function getDateTimeEndAttribute()
    {
        if ($this->duration>1){
            return $this->dateTime->addMinutes($this->duration);
        } else {
            return null;
        }

    }



}
