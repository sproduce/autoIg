<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photoLink extends Model
{
    use HasFactory;
    protected $fillable = ['photoId','linkUuid'];
}
