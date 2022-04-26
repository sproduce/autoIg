<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $personId
 * @property int $contractId
 * @property int $sum
 * @property bool $isFinish
 *
 */



class rentEventRental extends Model
{
    use HasFactory;
    protected $fillable = ['personId','contractId','isFinish','sum'];

}
