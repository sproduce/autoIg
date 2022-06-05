<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property $id
 * @property $name
 * @property $color
 * @property $action
 * @property $priority
 * @property $duration
 * @property $icon
 * @property $isToPay
 * @property $payOperationTypeId
 */
class rentEvent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color','action'];


    public function operationType()
    {
        return $this->hasOne(payOperationType::class,'id','payOperationTypeId')->withDefault();
    }


}
