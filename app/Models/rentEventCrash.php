<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $culprit
 * @property $comment
 */


class rentEventCrash extends Model
{
    use HasFactory;
    protected $fillable = ['comment','culprit'];
    private $coment,$culprit;
}
