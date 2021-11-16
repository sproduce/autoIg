<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarDriverContact extends Model
{
    use HasFactory;
    protected $fillable = ['phone','driverId'];
    private $phone,$driverId;

}
