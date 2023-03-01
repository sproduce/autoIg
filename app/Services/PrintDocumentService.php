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
        $contractObj->sts = $this->timeSheetServ->getLastTimeSheetModel(config('rentEvent.eventSts'), $contractObj->car->id);
        $contractObj->pts = $this->timeSheetServ->getLastTimeSheetModel(config('rentEvent.eventPts'), $contractObj->car->id);
        $contractObj->osago = $this->timeSheetServ->getLastTimeSheetModel(config('rentEvent.eventOsago'), $contractObj->car->id);
        $contractObj->kasko = $this->timeSheetServ->getLastTimeSheetModel(config('rentEvent.eventKasko'), $contractObj->car->id);
        $contractObj->license = $this->timeSheetServ->getLastTimeSheetModel(config('rentEvent.eventLicense'), $contractObj->car->id);
        
        //$variableArray[] = 'CAR_TAXLsd';
        foreach ($variableArray as $variable)
        {
            $returnArray[$variable] = '';
            if (isset($configVar[$variable])){
                $returnArray[$variable] = eval('return $contractObj->'.$configVar[$variable][0].';');
            }
            
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
    
    
    
    private function extendedCommand($commands,$key,$value,$templateDocument)
    {
        //$templateDocument->setImageValue($var, '/tmp/qr.jpeg');
        $barcodeObj = new \Com\Tecnick\Barcode\Barcode();
        foreach ($commands as $command){
            switch ($command){
                case 'qr':
                    $fileTmp = tmpfile();
                    $filePath = stream_get_meta_data($fileTmp)['uri'];
                    $qrCode = $barcodeObj->getBarcodeObj('QRCODE,H',$value, -2, -2, 'black', array(-1, -1, -1, -1))->setBackgroundColor('#ffffff');
                    file_put_contents($filePath, $qrCode->getPngData());
                    $templateDocument->setImageValue($key, $filePath);
                break;
            }
                    
        }
    }
    
    
    
    
    

    public function contractPrintDocument(printDocument $printDocumentObj, $variableArray) 
    {
        $configVar = config('printDocument.variable');
        $filesObj = $this->photoServ->getFiles($printDocumentObj->uuid);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(Storage::disk('photo')->path($filesObj[0]->getFilePath()));
        //$templateProcessor->setImageValue('image', '/tmp/qr.jpeg');
        foreach($variableArray as $key => $value)
        {
            if (!$value){
                $templateProcessor->setValue($key,'');   
                continue;
            }
            if (isset($configVar[$key][2])){
                $this->extendedCommand($configVar[$key][2],$key,$value,$templateProcessor);
            } else {
                $templateProcessor->setValue($key,$value);   
            } 
        }
        
        
        $tmpPath = '/tmp/'.$printDocumentObj->id.rand(0,9).'docx';
        $templateProcessor->saveAs($tmpPath);
        return $tmpPath;
    }
    
    
    
    
}
