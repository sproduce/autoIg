<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentContract extends Model
{
    use HasFactory;

    public function driver()
    {

        return $this->hasOne(rentCarDriver::class,'id','driverId');

    }


}