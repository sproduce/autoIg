<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rentCarGroup extends Model
{
    use HasFactory;
    
    protected $fillable = ['name','nickName','start','finish'];
    protected $dates = ['start','finish'];

    
    
    
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

    public function getStartTextAttribute()
    {
        if ($this->start){
            return $this->start->format('d-m-Y');
        }
        return '';
    }

    public function getFinishTextAttribute()
    {
       
        if ($this->finish){
            return $this->finish->format('d-m-Y');
        }
        return '';
    }
}
