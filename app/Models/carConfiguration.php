<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class carConfiguration extends Model
{
    use HasFactory;
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
        return $this->hasOne(carGeneration::class,'id','generationId');
    }

    public function owner()
    {
        return $this->hasOne(carOwner::class,'id','ownerId');
    }

    public function engine()
    {
        return $this->hasOne(carEngineType::class,'id','engineTypeId');
    }

    public function transmission()
    {
        return $this->hasOne(carTransmissionType::class,'id','transmissionTypeId');

    }

    public function body()
    {
        return $this->hasOne(carType::class,'id','typeId');
    }


}
