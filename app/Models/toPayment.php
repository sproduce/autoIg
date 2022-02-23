<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class toPayment extends Model
{
    use HasFactory;

    public function contract()
    {
        return $this->hasOne(rentContract::class,'id','contractId')->withDefault();
    }

}
