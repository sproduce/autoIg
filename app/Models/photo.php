<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class photo extends Model
{
    private $filePath;
    
    use HasFactory;
    protected $fillable = ['photo','fileType','fileName','fileExt'];
    
    
    public function setFilePath($filePath) 
    {
        $this->filePath = $filePath;
    }
    
    public function getFilePath() 
    {
        return $this->filePath;
    }
    
    
    
}
