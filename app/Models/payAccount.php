<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payAccount extends Model
{
    use HasFactory;
    
    
    public function payments() 
    {
        return $this->hasMany(rentPayment::class,'payAccountId','id');
    } 
    
    
    public function paymentSum(): int
    {
        return $this->hasMany(rentPayment::class,'payAccountId','id')->sum('payment');
    } 
}
