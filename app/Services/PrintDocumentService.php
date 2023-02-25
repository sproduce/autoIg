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
            $returnArray[$variable] = '';
            switch ($variable) {
                case 'SSE_cnsh'://полное название организации
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->fullName;
                    break;
                case 'SSE_ogrn'://ОГРН
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->ogrn;
                    break;
                case 'SSE_inn'://ИНН организации
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->inn;
                    break;
                case 'SSE_cnfu'://полное название организации
                    $tmp = 'subjectFrom->actualEntity->fullName';
                    $returnArray[$variable] = eval('return $contractObj->'.$tmp.';');
                    break;
                case 'SSE_uregaddr'://Адрес регистрации юр лица
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->address;
                    break;
                case 'SSE_accn'://Номер счёта
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPayment->checkingAccount;
                    break;
                case 'SSE_babik'://БИК банка
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPayment->bankBik;
                    break;
                case 'SSE_ban'://Наименование банка
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPayment->bankName;
                    break;
                case 'SSE_fns'://Сокращенная форма ФИО (Иванов И.И.)
                    if ($contractObj->subjectFrom->surname && $contractObj->subjectFrom->name && $contractObj->subjectFrom->patronymic){
                        $returnArray[$variable] = $contractObj->subjectFrom->surname.' '.$contractObj->subjectFrom->name[0].'. '.$contractObj->subjectFrom->patronymic[0].'.';
                    } 
                    break;

                
                case 'SSE_bd'://Дата рождения
                    if ($contractObj->subjectFrom->birthday){
                        $returnArray[$variable] = $contractObj->subjectFrom->birthday->format('d-m-Y');
                    } 
                    break;
                case 'SSE_bp'://Место рождения
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->birthplace;
                    break;
                case 'SSE_pasn'://Серия и номер паспорта
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->number;
                    break;
                case 'SSE_pash'://Кем выдан паспорт
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->issuedBy;
                    break;
                case 'SSE_pasd'://Дата выдачи паспорта
                    if ($contractObj->subjectFrom->actualPassport->dateIssued){
                        $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->dateIssued->format('d-m-Y');
                    }
                    break;
                case 'SSE_pasc'://Код подразделения паспорта
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->code;
                    break;
                
                case 'SSE_regaddr'://Адрес регистрации
                    $returnArray[$variable] = $contractObj->subjectFrom->actualPassport->placeResidence;
                    break;
                
                case 'SSE_lisn'://Серия и номер водительского удостоверения
                    $returnArray[$variable] = $contractObj->subjectFrom->actuallicense->number;
                    break;
                case 'SSE_lish'://Кем выдано водительское удостоверение
                    $returnArray[$variable] = $contractObj->subjectFrom->actuallicense->issuedBy;
                    break;
                case 'SSE_lisd'://Дата выдачи водительского удостоверения
                    if ($contractObj->subjectFrom->actuallicense->start){
                        $returnArray[$variable] = $contractObj->subjectFrom->actuallicense->start->format('d-m-Y');
                    }
                    break;
                case 'SSE_phone'://Номер телефона
                    $returnArray[$variable] = $contractObj->subjectFrom->actualContact->phone;
                    break;
                case 'SSE_ccn'://Номер карты
                    $returnArray[$variable] = $contractObj->subjectFrom->payAccount->cardNumber;
                    break;
                
                
                case 'SCL_babik'://БИК банка арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPayment->bankBik;
                    break;
                case 'SCL_ban'://Наименование банка арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPayment->bankName;
                    break;
                case 'SCL_ccn'://Номер карты арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->payAccount->cardNumber;
                    break;
                 case 'SCL_accn'://Номер счёта арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPayment->checkingAccount;
                    break;
                case 'SCL_phone'://Номер телефона Арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualContact->phone;
                    break;
                case 'SCL_lisd'://Дата выдачи водительского удостоверения
                    if ($contractObj->subjectTo->actuallicense->start){
                        $returnArray[$variable] = $contractObj->subjectTo->actuallicense->start->format('d-m-Y');
                    }
                    break;
                case 'SCL_lish'://Кем выдано водительское удостоверение
                    $returnArray[$variable] = $contractObj->subjectTo->actuallicense->issuedBy;
                    break;
                case 'SCL_lisn'://Серия и номер водительского удостоверения арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actuallicense->number;
                    break;
                case 'SCL_regaddr'://Адрес регистрации арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->placeResidence;
                    break;
                case 'SCL_pasc'://Код подразделения паспорта
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->code;
                    break;
                case 'SCL_pasd'://Дата выдачи паспорта
                    if ($contractObj->subjectTo->actualPassport->dateIssued){
                        $returnArray[$variable] = $contractObj->subjectTo->actualPassport->dateIssued->format('d-m-Y');
                    }
                    break;
                case 'SCL_pash'://Кем выдан паспорт
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->issuedBy;
                    break;
                case 'SCL_pasn'://Серия и номер паспорта арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->number;
                    break;
                
                 case 'SCL_bp'://Место рождения арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->birthplace;
                    break;
                case 'SCL_bd'://Дата рождения арендатора
                    if ($contractObj->subjectTo->birthday){
                        $returnArray[$variable] = $contractObj->subjectTo->birthday->format('d-m-Y');
                    } 
                    break;
                case 'SCL_fns'://Сокращенная форма ФИО (Иванов И.И.)
                    if ($contractObj->subjectTo->surname && $contractObj->subjectTo->name && $contractObj->subjectTo->patronymic){
                        $returnArray[$variable] = $contractObj->subjectTo->surname.' '.$contractObj->subjectTo->name[0].'. '.$contractObj->subjectTo->patronymic[0].'.';
                    } 
                    break;
                
                case 'SCL_cn'://полное название организации
                    $returnArray[$variable] = $contractObj->subjectTo->actualEntity->fullName;
                    break;   
                    
                 case 'SCL_addr'://Место жительства арендатора
                    $returnArray[$variable] = $contractObj->subjectTo->actualPassport->placeResidence;
                    break;      
                    
                    
                    
                    
                    
                    
                
                
                case 'CAR_Brand'://Марка автомобиля
                    $returnArray[$variable] = $contractObj->car->generation->model->brand->name;
                    break;
                case 'CAR_Model'://Модель автомобиля
                    $returnArray[$variable] = $contractObj->car->generation->model->name;
                    break;
                case 'CAR_VINn'://VIN номер автомобиля
                    $returnArray[$variable] = $contractObj->car->vin;
                    break;
                case 'CAR_Y'://Год выпуска автомобиля
                    $returnArray[$variable] = $contractObj->car->year;
                    break;
                case 'CAR_Power'://Мощность двигателя
                    $returnArray[$variable] = $contractObj->car->hp;
                    break;
                case 'CAR_StNum'://Регистрационный номер
                    $returnArray[$variable] = $stsObj->regNumber;
                    break;
                case 'CAR_STSd'://дата выдачи СТС
                    if ($stsObj->dateDocument){
                        $returnArray[$variable] = $stsObj->dateDocument->format('d-m-Y');
                    }
                    break;
                case 'CAR_STSn'://Серия и Номер СТС
                    $returnArray[$variable] = $stsObj->number;
                    break;
                case 'CAR_Col'://Цвет автомобиля
                    $returnArray[$variable] = $stsObj->color;
                    break;
                
                default :
                    $returnArray[$variable] = '';
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
