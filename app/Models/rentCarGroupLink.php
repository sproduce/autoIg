<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarGroupLink extends Model
{
    protected $fillable =['carId','groupId','start','finish'];
    use HasFactory;
}
