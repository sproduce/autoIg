<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 *
 * @property int $id
 * @property int $contractId
 * @property int $timeSheetId
 * @property int $sum
 * @property int $carId
 * @property int $paymentId
 * @property int $pId
 * @property string $comemnt
 *
 */

class toPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $sum;
    protected $fillable = ['contractId','timeSheetId','sum','carId','paymentId','pId','comment'];

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }






}
