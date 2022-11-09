<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @property int $id
 * @property $number
 * @property $regNumber
 * @property $passport
 * @property $color
 * @property $issued
 * @property $marks
 * @property $subjectId
 */

class rentEventDocumentTitle extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$number,$regNumber,$passport,$color,$issued,$marks,$subjectId;
    protected $fillable = ['number','regNumber','passport','color','issued','marks','subjectId'];
}
