<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property int $contractId
 * @property $comment
 *
 */
class rentEventOther extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$comment,$contractId;
    protected $fillable=['id','comment','contractId'];
}
