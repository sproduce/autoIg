<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $personId
 * @property int $contractId
 * @property int $clientId
 * @property int $type
 */



class rentEventTransfer extends Model
{
    use HasFactory;
    protected $fillable = ['personId','contractId','clientId','type'];
}
