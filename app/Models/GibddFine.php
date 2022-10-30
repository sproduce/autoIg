<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

 /**
 * @property $id
 * @property $sts
 * @property $regnumber
 * @property $decreeNumber
 * @property $sum
 * @property $dateDecree
 * @property $datePayMax
 * @property $unit
 * @property $receiver
 * @property $inn
 * @property $kpp
 * @property $bik
 * @property $kbk
 * @property $okato
 * @property $accountReceiver
 * @property $bankReceiver
 * @property $dateFine
 * @property $timeFine
 * @property $place
 * @property $koap
 * @property $sale
 * @property $dateSale
 * @property $sumSale
 * @property $entity
 * @property $closed
 * @property $timeSheetId
 */

class GibddFine extends Model
{
    use HasFactory;
    private  $id,$sts,$regnumber,$decreeNumber,$sum,$dateDecree,$datePayMax,$unit,$receiver,$inn,$kpp,$bik, $kbk, $okato, $accountReceiver, $bankReceiver, $dateFine, $timeFine, $place, $koap, $sale, $dateSale, $sumSale, $entity, $closed, $timeSheetId;
    protected $fillable = ['sts','regnumber','decreeNumber','sum','dateDecree','datePayMax','unit','receiver','inn','kpp','bik','kbk','okato','accountReceiver','bankReceiver','dateFine','timeFine','place','koap','sale','dateSale','sumSale','entity','closed','timeSheetId'];
    
}
