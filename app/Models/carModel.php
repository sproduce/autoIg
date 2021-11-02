<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class carModel extends Model
{
    use HasFactory;
    protected $fillable = ['name','brandId'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->uuid = (string) Str::uuid();
        });
    }

    public function generations(){

        return $this->hasMany(carGeneration::class,'modelId')->orderBy('name');
    }

    public function brand()
    {
        return $this->hasOne(carBrand::class,'id','brandId');

    }

}
