<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property $dateTimeOrder
 * @property $dateTimeFine
 * @property $datePaySale
 * @property $datePayMax
 * @property int $sum
 * @property int $sumSale
 * @property $uin
 * @property $childAllow
 *
 */


class rentEventFine extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['dateTimeOrder','dateTimeFine','datePaySale','sum','datePayMax','sumSale','uin'];
    protected $dates = ['dateTimeOrder','dateTimeFine','datePaySale','datePayMax'];

    
    
    
    
    
    public function getDatePaySaleTextAttribute() 
    {
       if ($this->datePaySale){
            $result = $this->datePaySale->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
    
    
    
     public function getDatePayMaxTextAttribute() 
    {
       if ($this->datePayMax){
            $result = $this->datePayMax->format('d-m-Y');
        } else {
            $result = '';
        }
        return $result;
    }
}
