<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class toPayment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['contractId','timeSheetId','sum','carId','paymentId','pId','comment'];

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }

}
