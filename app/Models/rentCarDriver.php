<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class rentCarDriver extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['surname','name','male','birthday','nickname','comment','regionId','patronymic'];
    private $id,$surname,$name,$male,$birthday,$nickname,$comment,$regionId,$patronymic;


    public function contacts()
    {
        return $this->hasMany(rentCarDriverContact::class,'driverId')->orderByDesc('id');
    }

    public function region()
    {
        return $this->hasOne(rentCarDriverRegion::class,'id','regionId');
    }

}
