<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarGroupLink extends Model
{
    protected $fillable =['carId','groupId','start','finish'];
    use HasFactory;

    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId');
    }

    public function getStartAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getFinishtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

}
