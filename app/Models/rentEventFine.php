<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property $dateTimeOrder
 * @property $dateTimeFine
 * @property $datePaySale
 * @property $datePayMax
 * @property int $sum
 * @property int $sumSale
 * @property $uin
 *
 */


class rentEventFine extends Model
{
    use HasFactory;
    protected $fillable = ['dateTimeOrder','dateTimeFine','datePaySale','sum','datePayMax','sumSale','uin'];
    protected $dates = ['dateTimeOrder','dateTimeFine','datePaySale','datePayMax'];

}
