<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class rentDocumentLicense extends Model
{
    use HasFactory;
    protected $dates = ['start','finish'];
    
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
        
}
