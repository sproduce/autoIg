<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $carId
 * @property int $groupId
 * @property $start
 * @property $finish
 *
 */

class rentCarGroupLink extends Model
{
    private $id,$carId,$groupId,$start,$finish;
    protected $fillable =['carId','groupId','start','finish'];
    protected $dates = ['start','finish'];
    use HasFactory;

    
    public function car()
    {
        return $this->hasOne(carConfiguration::class,'id','carId')->withDefault();
    }

}
