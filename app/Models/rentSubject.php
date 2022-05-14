<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
