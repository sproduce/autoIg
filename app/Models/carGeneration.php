<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class carGeneration extends Model
{
    use HasFactory;
    protected $fillable = ['name','modelId','start','finish'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($post) {
            $post->uuid = (string) Str::uuid();
        });
    }

    public function model()
    {
        return $this->hasOne(carModel::class,'id','modelId');

    }


}
