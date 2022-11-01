<?php

namespace App\Imports;

use App\Models\GibddFine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class GibddFineImport implements ToModel, WithValidation, SkipsOnFailure
{
    private $gibddFineRep;
    use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    function __construct(\App\Repositories\Interfaces\GibddFineRepositoryInterface $gibddRep)
    {
        $this->gibddFineRep = $gibddRep;
                
    }
    
    
    public function model(array $row)
    {
        if (strtotime($row[20])<0){
            $row[20] = $row[4];
        }

        $fineObj = $this->gibddFineRep->getFineByNumber($row[2]);
        $fineObj->sts = $row[0];
        $fineObj->regnumber = $row[1];
        $fineObj->decreeNumber = $row[2];
        $fineObj->sum = $row[3];
        $fineObj->dateDecree = date('Y-m-d',strtotime($row[4]));
        $fineObj->datePayMax = date('Y-m-d',strtotime($row[5]));
        $fineObj->unit = $row[6];
        $fineObj->receiver = $row[7];
        $fineObj->inn = $row[8];
        $fineObj->kpp = $row[9];
        $fineObj->bik = $row[10];
        $fineObj->kbk = $row[11];
        $fineObj->okato = $row[12];
        $fineObj->bankReceiver = $row[13];
        $fineObj->accountReceiver = $row[14];
        $fineObj->dateTimeFine = date('Y-m-d H:i',strtotime($row[15]." ".$row[16]));
        $fineObj->place = $row[17];
        $fineObj->koap = $row[18];
        $fineObj->sale = $row[19];
        $fineObj->dateSale = date('Y-m-d',strtotime($row[20]));
        $fineObj->sumSale = $row[21];
        $fineObj->entity = $row[22];
        if (!$fineObj->id){
            $fineObj->closed = 0;
            $fineObj->timeSheetId = null;
        }
        
        return $fineObj;

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
