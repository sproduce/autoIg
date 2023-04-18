<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



/**
 * @property int $id
 * @property $start
 * @property $finish
 * @property $finishFact
 * @property $number
 * @property $comment
 * @property int $typeId
 * @property int $statusId
 * @property int $price
 * @property int $carGroupId
 * @property int $subjectIdFrom
 * @property int $subjectIdTo
 * @property int $carId
 * @property $toAddForm
 *
 */


class rentContract extends Model
{
    use HasFactory;
    protected $dates = ['start','finish','finishFact'];
    //private $start,$finish,$finishFact,$typeId,$carGroupId,$statusId,$number,$comment,$price,$carId,$subjectIdFrom,$subjectIdTo,$toAddForm;
    protected $fillable = ['start','finish','finishFact','typeId','carGroupId','statusId','number','comment','carId','subjectIdFrom','subjectIdTo'];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->uuid = (string)Str::uuid();
        });
    }
    
    public function getStartTextAttribute() 
    {
        if ($this->start){
            $result = $this->start->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    } 
    public function getFinishTextAttribute() 
    {
        if ($this->finish){
            $result = $this->finish->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    } 
    
    
    
    
    public function type()
    {
        return $this->hasOne(rentContractType::class,'id','typeId')->withDefault();
    }

    public function status()
    {
        return $this->hasOne(rentContractStatus::class,'id','statusId')->withDefault();
    }
    public function carGroup()
    {
        return $this->hasOne(rentCarGroup::class,'id','carGroupId')->withDefault();
    }

    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId')->withDefault();
    }

    public function subjectFrom()
    {
        return $this->hasOne(rentSubject::class,'id','subjectIdFrom')->withDefault();
    }


    public function subjectTo()
    {
        return $this->hasOne(rentSubject::class,'id','subjectIdTo')->withDefault();
    }

    public function payments()
    {
        return $this->hasMany(rentPayment::class,'contractId','id');
    }

    
    public function files() 
    {
        return $this->hasMany(photoLink::class,'linkUuid','uuid');
    }
    
    
    
}
