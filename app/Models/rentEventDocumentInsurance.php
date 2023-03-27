<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property $number
 * @property $expiration
 */


class rentEventDocumentInsurance extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['expiration','dateDocument'];
    //protected $fillable = ['number','expiration','dateDocument'];
    
    
    
    public function subject()
    {
        return $this->hasOne(rentSubject::class,'id','subjectId')->withDefault();
    }
    
    public function subjectTo()
    {
        return $this->hasOne(rentSubject::class,'id','subjectToId')->withDefault();
    }
    
    
    
    
    public function getExpirationTextAttribute() 
    {
        if ($this->id&&$this->expiration){
            $result = $this->expiration->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
    public function getDateDocumentTextAttribute() 
    {
        if ($this->id&&$this->dateDocument){
            $result = $this->dateDocument->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
    
    
    
}
