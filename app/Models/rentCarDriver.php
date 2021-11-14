<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarDriver extends Model
{
    use HasFactory;
    protected $fillable = ['surname','name','male','birthday','nickname','comment'];
    private $id,$surname,$name,$male,$birthday,$nickname,$comment;


    public function contacts()
    {
        return $this->hasMany(rentCarDriverContact::class,'driverId')->orderByDesc('id');
    }


}
