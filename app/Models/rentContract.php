<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentContract extends Model
{
    use HasFactory;
    protected $dates=['start'];
    private $start,$finish,$finishFact,$typeId,$driverId,$carId,$statusId,$tariffId,$balance,$deposit,$number,$comment,$sum;
    protected $fillable =['start','finish','finishFact','typeId','driverId','carId','statusId','tariffId','balance','deposit','number','comment','sum'];

    public function driver()
    {

        return $this->hasOne(rentCarDriver::class,'id','driverId')->withDefault();

    }
    public function type()
    {
        return $this->hasOne(rentContractType::class,'id','typeId')->withDefault();
    }
    public function tariff()
    {
        return $this->hasOne(rentContractTariff::class,'id','tariffId')->withDefault();
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
