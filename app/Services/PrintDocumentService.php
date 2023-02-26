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
    {
        $configVar = config('printDocument.variable');
        $contractObj->sts = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventSts'), $contractObj->car->id);
        $contractObj->pts = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventPts'), $contractObj->car->id);
        $contractObj->osago = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventOsago'), $contractObj->car->id);
        $contractObj->kasko = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventKasko'), $contractObj->car->id);
        $contractObj->license = $this->timeSheetServ->getLastTimeSheet(config('rentEvent.eventLicense'), $contractObj->car->id);
        
        //$variableArray[] = 'CAR_TAXLsd';
        foreach ($variableArray as $variable)
        {
            $returnArray[$variable] = '';
            $returnArray[$variable] = eval('return $contractObj->'.$configVar[$variable][0].';');
        }
        
        return $returnArray;
        
    }
    
    
    
    public function contractPrepareDocument(printDocument $printDocumentObj, rentContract $contractObj) 
    {
        $filesObj = $this->photoServ->getFiles($printDocumentObj->uuid);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage::disk('photo')->path($filesObj[0]->getFilePath()));
        $variables = $templateProcessor->getVariables();
        $setVariable = $this->contractSetVariable($contractObj, $variables);
        return $setVariable;
    }
    
    

    public function contractPrintDocument(printDocument $printDocumentObj, $variableArray) 
    {
        $filesObj = $this->photoServ->getFiles($printDocumentObj->uuid);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage::disk('photo')->path($filesObj[0]->getFilePath()));
        
        foreach($variableArray as $key => $variable)
        {
            if ($variable){
                $templateProcessor->setValue($key,$variable);   
            } else {
                $templateProcessor->setValue($key,'');   
            }
          
        }
        $tmpPath = '/tmp/'.$printDocumentObj->id.rand(0,9).'docx';
        $templateProcessor->saveAs($tmpPath);
        return $tmpPath;
    }
    
    
    
    
}
