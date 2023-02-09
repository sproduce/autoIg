<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\photoLink;


class printDocument extends Model
{
    use HasFactory;
     protected static function boot()
        {
            parent::boot();
            static::creating(function ($post) {
                $post->uuid = (string)Str::uuid();
            });
        }
        
        
    public function fileLink() 
    {
        return $this->hasOne(photoLink::class,'linkUuid','uuid')->withDefault();
    }
        
        
        
}
