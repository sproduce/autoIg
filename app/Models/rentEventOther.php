<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property $comment
 *
 */
class rentEventOther extends Model
{
    use HasFactory;
    private $id,$comment;
    protected $fillable=['id','comment'];
}
