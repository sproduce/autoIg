<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 */

class rentEventPhotocontrol extends Model
{
    use HasFactory;
    protected $fillable =['uuid','comment'];
}
