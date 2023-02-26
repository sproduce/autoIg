<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class rentDocumentEntity extends Model
{
    use HasFactory;
    protected $dates = ['dateReg'];
    
    
    protected static function boot()
        {
            parent::boot();
            static::creating(function ($post) {
                $post->uuid = (string)Str::uuid();
            });
        }
        
        
        
        
        
        
        
    public function files() 
    {
        return $this->hasMany(photoLink::class,'linkUuid','uuid');
    }   
    
    
    public function getDateRegTextAttribute() 
    {
        if ($this->id&&$this->dateReg){
            $result = $this->dateReg->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
}
