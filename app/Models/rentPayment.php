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
    protected $fillable =['dateTime','payAccountId','payOperationTypeId','payment','balance','name','carId','carGroupId','finished','pid','comm'];
    //protected $dateFormat = 'Y-m-d';


    public function account()
    {
        return $this->hasOne(payAccount::class,'id','payAccountId');
    }

    public function operationType()
    {
        return $this->hasOne(payOperationType::class,'id','payOperationTypeId');
    }

    public function getdateTimeAttribute($value)
    {
        return date('d-m-Y H:m', strtotime($value));
    }
}
