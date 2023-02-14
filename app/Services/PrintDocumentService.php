<?php
namespace App\Services;

use App\Repositories\Interfaces\PrintDocumentRepositoryInterface;
use App\Services\PhotoService;
use Illuminate\Support\Facades\Storage;
use App\Services\TimeSheetService;
use App\Models\printDocument;
use App\Models\rentContract;

Class PrintDocumentService {

    private $printDocumentRep,$photoServ,$timeSheetServ;

    function __construct(
            PrintDocumentRepositoryInterface $printDocumentRep, 
            PhotoService $photoServ,
            TimeSheetService $timeSheetServ
    ){
        $this->printDocumentRep = $printDocumentRep;
        $this->photoServ = $photoServ;
        $this->timeSheetServ = $timeSheetServ;
    }


    public function getPrintDocument($printDocumentId) 
    {
        return $this->printDocumentRep->getPrintDocument($printDocumentId);
    }
    
    
    private function contractSetVariable(rentContract $contractObj, $variableArray)
    {//config('rentEvent.eventSts');
        $stsObj = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventSts'), $contractObj->car->id);
        foreach ($variableArray as $variable)
        {
            switch ($variable) {
                case 'SSE_ogrn':
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->ogrn;
                    break;
                case 'SSE_inn':
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->inn;
                    break;
                case 'SSE_cnfu':
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->fullName;
                    break;
                case 'SSE_uregaddr':
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->address;
                    break;
                case 'CAR_Brand':
                    $returnArray[$variable] = $contractObj->car->generation->model->brand->name;
                    break;
                case 'CAR_Model':
                    $returnArray[$variable] = $contractObj->car->generation->model->name;
                    break;
                case 'CAR_StNum':
                    $returnArray[$variable] = $stsObj->regNumber;
                    break;
            } 
        }
        
        return $returnArray;
        
    }
    
    

    public function contractPrintDocument(printDocument $printDocumentObj, rentContract $contractObj) 
    {
        $filesObj = $this->photoServ->getFiles($printDocumentObj->uuid);
        //$filePath = $this->photoServ->getFiles($uuid);
        
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage::disk('photo')->path($filesObj[0]->getFilePath()));
        $variables = $templateProcessor->getVariables();
        $setVariable = $this->contractSetVariable($contractObj, $variables);
        foreach($setVariable as $key => $variable)
        {
            if ($variable){
                $templateProcessor->setValue($key,$variable);   
            } else {
                $templateProcessor->setValue($key,'');   
            }
          
        }
        $templateProcessor->saveAs('/tmp/'.$contractObj->uuid.'.docx');
        return '/tmp/'.$contractObj->uuid.'.docx';
    }
    
    
    
    
}
