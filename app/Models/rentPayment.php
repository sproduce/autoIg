<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 *@property int $id
 *@property int $pid
 *@property int $payAccountId
 *@property int $payOperationTypeId
 *@property int $payment
 *@property int $balance
 *@property int $carId
 *@property int $contractId
 *@property int $carGroupId
 *@property int $subjectId
 *@property $dateTime
 *@property boolean $finished
 *@property $name
 *@property $comm
 *
 **/


class rentPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$dateTime,$payAccountId,$payOperationTypeId,$payment,$balance,$name,$carId,$carGroupId,$finished,$pid,$comm,$contractId,$subjectId;
    protected $fillable =['dateTime','payAccountId','payOperationTypeId','payment','balance','name','carId','carGroupId','finished','pid','comm','comment','contractId','subjectId'];


    protected $dates=['dateTime'];


    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId')->withDefault();
    }

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }


    public function account()
    {
        return $this->hasOne(payAccount::class,'id','payAccountId')->withDefault();
    }

    public function operationType()
    {
        return $this->hasOne(payOperationType::class,'id','payOperationTypeId')->withDefault();
    }

    public function carGroup()
    {
        return $this->hasOne(rentCarGroup::class,'id','carGroupId')->withDefault();
    }

    public function subject()
    {
        return $this->hasOne(rentSubject::class,'id','subjectId')->withDefault();
    }

    //public function getdateTimeAttribute($value)
   // {
   //     return date('d-m-Y H:i', strtotime($value));
   // }




}
