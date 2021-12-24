<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class timeSheet extends Model
{
    use HasFactory;
    protected $fillable = ['carId', 'eventId','dateTime','sum','comment'];



    public function event()
    {
        return $this->hasOne(rentEvent::class,'id','eventId')->withDefault();
    }


}
