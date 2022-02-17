<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeSheet extends Model
{
    use HasFactory;
    protected $fillable = ['carId', 'eventId','dateTime','sum','comment','mileage','pId','color','duration','dataId','contractId'];

    protected $dates=['dateTime','fromDate','toDate'];

    protected static function boot()
    {
        parent::boot();
        static::created(function ($post) {
            if (!$post->pId) {
                $post->pId = $post->id;
                $post->save();
            }
        });
    }

    public function event()
    {
        return $this->hasOne(rentEvent::class,'id','eventId')->withDefault();
    }

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }



}
