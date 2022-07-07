<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $subjectId
 * @property int $contractId
 * @property int $sum
 * @property int $comment
 *
 */

class rentEventService extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$subjectId,$contractId,$comment,$sum;
    protected $fillable = ['id','subjectId','contractId','comment','sum'];
}
