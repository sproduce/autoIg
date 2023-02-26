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
        
    
    public function getStartTextAttribute() 
    {
        if ($this->id&&$this->start){
            $result = $this->start->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
    public function getFinishTextAttribute() 
    {
        if ($this->id&&$this->finish){
            $result = $this->finish->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
}
