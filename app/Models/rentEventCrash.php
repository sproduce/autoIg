<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentEventCrash extends Model
{
    use HasFactory;
    protected $fillable = ['comment','culprit','sum'];
}
