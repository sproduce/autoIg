<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentEventFine extends Model
{
    use HasFactory;
    protected $fillable = ['dateTimeOrder','dateTimeFine','datePaySale','sum','datePayMax','sumSale','uin'];
    protected $dates=['dateTimeOrder','dateTimeFine','datePaySale','datePayMax'];



    public function getdateTimeOrderAttribute($value)
    {
        return Carbon::create($value);
    }

    public function getdateTimeFineAttribute($value)
    {
        return Carbon::create($value);
    }

    public function getdatePaySaleAttribute($value)
    {
        return Carbon::create($value);
    }
    public function getdatePayMaxAttribute($value)
    {
        return Carbon::create($value);
    }
}
