<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\photo;


class photoLink extends Model
{
    use HasFactory;
    protected $fillable = ['photoId','linkUuid'];
    
    
    public function files() 
    {
        return $this->hasMany(photo::class,'id','photoId');
    }
       
    
    
}
