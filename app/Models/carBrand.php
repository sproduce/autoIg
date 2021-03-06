<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class carBrand extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->uuid = (string) Str::uuid();
        });
    }

    public function models(){

        return $this->hasMany(carModel::class,'brandid')->orderBy('name');
    }



}
