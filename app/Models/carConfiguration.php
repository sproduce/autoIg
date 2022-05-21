<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
//use App\Models\rentCarGroupLink;

/**
 * @property int $id
 * @property int $pid
 * @property int $subjectIdOwner
 * @property int $subjectIdFrom
 * @property $uuid
 * @property int $generationId
 * @property int $typeId
 * @property int $engineTypeId
 * @property int $transmissionTypeId
 * @property $hp
 * @property $dateStart
 * @property $dateFinish
 * @property $comment
 * @property $displacement
 * @property $regNumber
 * @property $vin
 * @property $nickName
 * @property $color
 * @property $year
 */


class carConfiguration extends Model
{
    use HasFactory;
    private  $id,$pid,$subjectIdOwner,$subjectIdFrom,$uuid,
        $generationId,$typeId,$engineTypeId,$transmissionTypeId,$hp,$dateStart,$dateFinish,$comment,$displacement,
        $regNumber,$vin,$nickName,$color,$year;



    public function generation()
    {
        return $this->hasOne(carGeneration::class,'id','generationId')->withDefault();

    }

    public function model()
    {
        //return $this->generation()->hasOne(carModel::class,'id','modelId');
    }

    public function brand()
    {

    }

    public function engine()
    {
        return $this->hasOne(carEngineType::class,'id','engineTypeId')->withDefault();
    }

    public function transmission()
    {
        return $this->hasOne(carTransmissionType::class,'id','transmissionTypeId')->withDefault();

    }

    public function body()
    {
        return $this->hasOne(carType::class,'id','typeId')->withDefault();
    }

    public function linkCarGroup()
    {
      return $this->hasMany(rentCarGroupLink::class,'carId');
    }

    public function timeSheet($date)
    {
        $from=$date->format('Y-m-d');
        $to=$date->addDays(1)->format('Y-m-d');
        $result=$this->hasMany(timeSheet::class,'carId')->whereBetween('dateTime',[$from,$to])->get();
        return $result;

    }




}
