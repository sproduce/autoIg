<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentEventTransfer extends Model
{
    use HasFactory;
    protected $fillable = ['personId','contractId','clientId','type'];
}