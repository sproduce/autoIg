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
 * @property int $paymentId
 * @property int $pId
 * @property int $subjectIdFrom
 * @property int $subjectIdTo
 * @property string $comment
 * @property $payUp
 *
 */

class toPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$contractId,$timeSheetId,$sum,$paymentId,$pId,$subjectIdFrom,$subjectIdTo,$comment,$payUp;
    protected $fillable = ['contractId','timeSheetId','sum','paymentId','pId','comment','subjectIdFrom','subjectIdTo','payUp'];
    protected $dates = ['dateTime'];

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }


    public function rentEvent()
    {
        return $this->hasOne(rentEvent::class,'id','contractId')->withDefault();
    }





}
