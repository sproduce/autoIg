<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int $carId
 * @property int $eventId
 * @property $dateTime
 * @property string $comment
 * @property int $dataId
 * @property int $mileage
 * @property $color
 * @property $uuid
 * @property int $duration
 * @property int $sum
 * @property int $contractId
 * @property int $pId
 */



class timeSheet extends Model
{
    use HasFactory;
    use SoftDeletes;
    //private $id,$carId,$eventId,$dateTime,$comment,$dataId,$mileage,$color,$uuid,$duration,$sum,$contractId,$pId;
    //private $dateTime,$comment,$dataId,$eventId;
    //protected $fillable = ['carId', 'eventId','dateTime','comment','mileage','color','duration','dataId','pId','uuid'];

    protected $dates = ['dateTime','fromDate','toDate'];

    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->uuid = (string)Str::uuid();
        });
    }
    
    
    
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
        if ($this->id){
            return $this->hasOne(toPayment::class,'timeSheetId','id')->whereColumn('id','pId')->withDefault();
        } else {
            return new toPayment();
        }

    }




    public function getDateTimeTextAttribute() 
    {
       if ($this->id&&$this->dateTime){
            $result = $this->dateTime->format('d-m-Y H:i');
        } else {
            $result = '';
        }
        return $result;
    }
    
    public function getDateTextAttribute() 
    {
       if ($this->id&&$this->dateTime){
            $result = $this->dateTime->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    

    protected function getDateTimeEndAttribute()
    {
        if ($this->duration>1){
            return $this->dateTime->addMinutes($this->duration);
        } else {
            return null;
        }

    }
    
    
    
    protected function getDurationTextAttribute()
    {
        $hour = intdiv($this->duration,60);
        $minute = $this->duration % 60;
        if ($minute<10);
        {
            $minute = '0'.$minute;
        }
        return $hour.':'.$minute;
    }
    
    


    public function files() 
    {
        return $this->hasMany(photoLink::class,'linkUuid','uuid');
    } 
    
    

}
