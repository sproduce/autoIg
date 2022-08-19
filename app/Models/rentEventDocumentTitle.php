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
 */

class rentEventDocumentTitle extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$number,$regNumber,$passport;
    protected $fillable = ['number','regNumber','passport'];
}
