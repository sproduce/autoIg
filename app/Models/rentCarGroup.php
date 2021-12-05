<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarGroup extends Model
{
    use HasFactory;
    protected $fillable =['name','nickName','start','finish'];

    public function cars()
    {
        //$this->hasMany('')
    }

    public function getStartAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getFinishAttribute($value)
    {
        if($value){
            return date('d-m-Y', strtotime($value));
        }

    }


}
