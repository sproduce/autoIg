<?php

namespace App\Imports;

use App\Models\GibddFine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class GibddFineImport implements ToModel, WithValidation, SkipsOnFailure
{
    private $gibddFineRep,$fromFile;
    use SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    function __construct(\App\Repositories\Interfaces\GibddFineRepositoryInterface $gibddRep,$fromFile)
    {
        $this->gibddFineRep = $gibddRep;
        $this->fromFile = $fromFile;
    }
    
    
    public function model(array $row)
    {
        if (strtotime($row[20])<0){
            $row[20] = $row[4];
        }
        $fileName = basename($this->fromFile);
        preg_match("/\d{2}.\d{2}.\d{4}/",  $fileName, $dateFile);
        $fineObj = $this->gibddFineRep->getFineByNumber($row[2]);
        
                
        $fineObj->sts = $fineObj->sts ?? $row[0];
        $fineObj->regnumber = $fineObj->regnumber ?? $row[1];
        $fineObj->decreeNumber = $fineObj->decreeNumber ?? $row[2];
        $fineObj->sum = $row[3];
        
        $fineObj->dateDecree = $fineObj->dateDecree ?? date('Y-m-d',strtotime($row[4]));
        $fineObj->datePayMax = $fineObj->datePayMax ?? date('Y-m-d',strtotime($row[5]));
        $fineObj->unit = $fineObj->unit ?? $row[6];
        $fineObj->receiver = $fineObj->receiver ?? $row[7];
        $fineObj->inn = $fineObj->inn ?? $row[8];
        $fineObj->kpp = $fineObj->kpp ?? $row[9];
        $fineObj->bik = $fineObj->bik ?? $row[10];
        $fineObj->kbk = $fineObj->kbk ?? $row[11];
        $fineObj->okato = $fineObj->okato ?? $row[12];
        $fineObj->bankReceiver = $fineObj->bankReceiver ?? $row[13];
        $fineObj->accountReceiver = $fineObj->accountReceiver ?? $row[14];
        if ($row[15])
            $fineObj->dateTimeFine = $fineObj->dateTimeFine ?? date('Y-m-d H:i',strtotime($row[15]." ".$row[16]));
        $fineObj->place = $fineObj->place ?? $row[17];
        $fineObj->koap = $fineObj->koap ?? $row[18];
        $fineObj->sale = $fineObj->sale ?? $row[19];
        $fineObj->dateSale = $fineObj->dateSale ?? date('Y-m-d',strtotime($row[20]));
        $fineObj->sumSale = $fineObj->sumSale ?? $row[21];
        $fineObj->entity = $fineObj->entity ?? $row[22];
        $fineObj->fromFile = $fileName;
        $fineObj->dateFile = date('Y-m-d',strtotime($dateFile[0]));
        $fineObj->closed = 0;
        if (!$fineObj->id){
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
