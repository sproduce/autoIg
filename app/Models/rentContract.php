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
 * @property int $carId
 * @property int $statusId
 * @property int $balance
 * @property int $deposit
 * @property int $sum
 * @property int $price
 *
 */


class rentContract extends Model
{
    use HasFactory;
    protected $dates=['start'];
    private $start,$finish,$finishFact,$typeId,$driverId,$carId,$statusId,$balance,$deposit,$number,$comment,$sum,$price;
    protected $fillable =['start','finish','finishFact','typeId','driverId','carId','statusId','tariffId','balance','deposit','number','comment','sum'];

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

    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId')->withDefault();
    }

}
