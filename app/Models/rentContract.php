<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




/**
 * @property int $id
 * @property $start
 * @property $finish
 * @property $finishFact
 * @property $number
 * @property $comment
 * @property int $typeId
 * @property int $driverId
 * @property int $statusId
 * @property int $balance
 * @property int $deposit
 * @property int $sum
 * @property int $price
 * @property int $carGroupId
 * @property int $carId
 *
 */


class rentContract extends Model
{
    use HasFactory;
    protected $dates=['start','finish','finishFact'];
    private $start,$finish,$finishFact,$typeId,$driverId,$carGroupId,$statusId,$balance,$deposit,$number,$comment,$sum,$price,$carId;
    protected $fillable =['start','finish','finishFact','typeId','driverId','carGroupId','statusId','tariffId','balance','deposit','number','comment','sum','carId'];

    public function driver()
    {

        return $this->hasOne(rentCarDriver::class,'id','driverId')->withDefault();

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



}
