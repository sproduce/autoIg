<?php

namespace App\Imports;

use App\Models\GibddFine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class GibddFineImport implements ToModel, WithValidation, SkipsOnFailure
{
     use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        if (strtotime($row[20])<0){
            $row[20] = $row[4];
        }

        
        return new GibddFine([
            'sts' => $row[0],
            'regnumber' => $row[1],
            'decreeNumber' => $row[2],
            'sum' => $row[3],
            'dateDecree' => date('Y-m-d',strtotime($row[4])),
            'datePayMax' => date('Y-m-d',strtotime($row[5])),
            'unit' => $row[6],
            'receiver' => $row[7],
            'inn' => $row[8],
            'kpp' => $row[9],
            'bik' => $row[10],
            'kbk' => $row[11],
            'okato' => $row[12],
            'bankReceiver' => $row[13],
            'accountReceiver' => $row[14],
            'dateFine' => date('Y-m-d',strtotime($row[15])),
            'timeFine' => $row[16],
            'place' => $row[17],
            'koap' => $row[18],
            'sale' => $row[19],
            'dateSale' => date('Y-m-d',strtotime($row[20])),
            'sumSale' => $row[21],
            'entity' => $row[22],
            'closed' => 0,
            'timeSheetId' => null,
        ]);
    }
    public function rules(): array
    {
        return [
            '3' => 'integer',
            '19' => 'integer',
            '21' => 'integer',
        ];
    }

    

}
