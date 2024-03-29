<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

//  $table->uuid('linkUuid');
//              $table->string('number');
//              $table->string('birthplace')->nullable();
//              $table->date('dateIssued');
//              $table->string('issuedBy');
//            $table->string('code')->nullable();
//              $table->string('placeResidence');
//            $table->date('dateResidence');



class rentDocumentPassport extends Model
{
    use HasFactory;
    protected $dates = ['dateIssued','dateResidence'];
    
    
    public function getDateIssuedTextAttribute() 
    {
        if ($this->id&&$this->dateIssued){
            $result = $this->dateIssued->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
   public function getDateResidenceTextAttribute() 
    {
        if ($this->id&&$this->dateResidence){
            $result = $this->dateResidence->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    } 
    
    
    
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
