<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentEventFine extends Model
{
    use HasFactory;
    protected $fillable = ['dateTimeOrder','dateTimeFine','datePaySale','sum','datePayMax','sumSale','uin'];
    protected $dates=['dateTimeOrder','dateTimeFine','datePaySale','datePayMax'];
}
