<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentAdditional extends Model
{
    use HasFactory;
    protected $fillable = ['contractId','timeSheetId','toPaymentsId','sum','isPay'];
}
