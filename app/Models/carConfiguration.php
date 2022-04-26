<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


/**
 * @property int $id
 * @property $nickName
 * @property $regNumber
 */


class carConfiguration extends Model
{
    use HasFactory;

    /**
     * @var mixed
     */
    private $generationId;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            if (!$post->displacement){
                $post->displacement=0;
            }
            if (!$post->hp){
                $post->hp=0;
            }
            $post->uuid = (string) Str::uuid();

        });
        static::created(function ($post) {
            if (!$post->pid){
                $post->pid = $post->id;
                $post->save();
            }
        });
    }


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

    public function owner()
    {
        return $this->hasOne(carOwner::class,'id','ownerId')->withDefault();
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

    public function timeSheet($date)
    {
        $from=$date->format('Y-m-d');
        $to=$date->addDays(1)->format('Y-m-d');
        $result=$this->hasMany(timeSheet::class,'carId')->whereBetween('dateTime',[$from,$to])->get();
        return $result;

    }




}
