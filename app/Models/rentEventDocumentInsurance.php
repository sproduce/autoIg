<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property $number
 * @property $expiration
 */


class rentEventDocumentInsurance extends Model
{
    use HasFactory;
    use SoftDeletes;
    private $id,$number,$expiration;
    protected $fillable = ['number','expiration','dateDocument'];
}
