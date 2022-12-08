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
 * @property $dateTimeFine
 * @property $place
 * @property $koap
 * @property $sale
 * @property $dateSale
 * @property $sumSale
 * @property $entity
 * @property $closed
 * @property $timeSheetId
 * @property $fromFile
 * @property $dateFile
 */

class GibddFine extends Model
{
    use HasFactory;
    private  $id,$sts,$regnumber,$decreeNumber,$sum,$dateDecree,$datePayMax,$unit,$receiver,$inn,$kpp,$bik, $kbk, $okato, $accountReceiver, $bankReceiver, $dateFine, $timeFine, $place, $koap, $sale, $dateSale, $sumSale, $entity, $closed, $timeSheetId,$fromFile,$dateFile;
    protected $fillable = ['sts','regnumber','decreeNumber','sum','dateDecree','datePayMax','unit','receiver','inn','kpp','bik','kbk','okato','accountReceiver','bankReceiver','dateTimeFine','place','koap','sale','dateSale','sumSale','entity','closed','timeSheetId','fromFile','dateFile'];
    protected $dates = ['dateDecree','datePayMax','dateTimeFine','dateSale','dateFile'];
}
