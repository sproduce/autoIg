<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


/**
 * @property int $id
 * @property int $pid
 * @property int $payAccountId
 * @property int $regionId
 * @property $surname
 * @property $name
 * @property $patronymic
 * @property $companyName
 * @property $nickname
 * @property $birthday
 * @property $comment
 * @property boolean $male
 * @property boolean $individual
 * @property boolean $client
 * @property boolean $carOwner
 * @property boolean $accessible
 *
 **/


class rentSubject extends Model
{
    use HasFactory;
    private $id,$pid,$payAccountId,$regionId,$surname,$name,$patronymic,$companyName,$nickname,$birthday,$comment,$male,$individual,$client,$carOwner,$accessible;
    protected $fillable = ['pid','payAccountId','regionId','surname','name','patronymic','companyName','nickname','birthday','comment','male','individual','client','carOwner','accessible'];
    protected $dates=['birthday'];

    protected static function boot()
        {
            parent::boot();
            static::creating(function ($post) {
                $post->uuid = (string)Str::uuid();
            });
        }

        
    public function contacts()
    {
        return $this->hasMany(rentSubjectContact::class,'subjectId','id');
    }    
    
    public function region()
    {
        return $this->hasOne(rentSubjectRegion::class,'id','regionId')->withDefault();
    }    
    
    
    
    public function passports()
    {
        return $this->hasMany(rentDocumentPassport::class,'linkUuid','uuid');
    }
    
    public function payments()
    {
        return $this->hasMany(rentDocumentPayment::class,'linkUuid','uuid');
    }
    
    public function licenses() 
    {
         return $this->hasMany(rentDocumentLicense::class,'linkUuid','uuid');
    }
    
}
