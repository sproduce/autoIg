<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class rentPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$dateTime,$payAccountId,$payOperationTypeId,$payment,$balance,$name,$carId,$carGroupId,$finished,$pid,$comm;
    protected $fillable =['dateTime','payAccountId','payOperationTypeId','payment','balance','name','carId','carGroupId','finished','pid','comm','comment','contractId','carDriverId','carOwnerId'];


    protected $dates=['dateTime'];
      //protected $dateFormat = 'Y-m-d';


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

    public function carOwner()
    {
        return $this->hasOne(carOwner::class,'id','carOwnerId')->withDefault();
    }

    public function carGroup()
    {
        return $this->hasOne(rentCarGroup::class,'id','carGroupId')->withDefault();
    }

    public function carDriver()
    {
        return $this->hasOne(rentCarDriver::class,'id','carDriverId')->withDefault();
    }


    //public function getdateTimeAttribute($value)
   // {
   //     return date('d-m-Y H:i', strtotime($value));
   // }




}
