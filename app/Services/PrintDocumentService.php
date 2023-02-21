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
    
    
//    
//    
//	
//
//	
//    ${SSE_ln} - Фамилия другие падежи
//    ${SSE_fn} - Имя другие падежи
//    ${SSE_sn} - Отчество другие падежи
//    ${SSE_fns} - Сокращенная форма ФИО (Иванов И.И.)
//	
//	
//	
//	
//	
//    ${SSE_bd} - Дата рождения
//    ${SSE_bp} - Место рождения
//    ${SSE_pasn} - Серия и номер паспорта
//    
//    ${SSE_pash} - Кем выдан паспорт
//    ${SSE_pasd} - Дата выдачи паспорта
//    ${SSE_pasc} - Код подразделения паспорта
//    ${SSE_regaddr} - Адрес регистрации
//    
//    ${SSE_lisn} - Серия и номер водительского удостоверения
//    ${SSE_lish} - Кем выдано водительское удостоверение
//    ${SSE_lisd} - Дата выдачи водительского удостоверения
//    
//    ${SSE_phone} - Номер телефона
//    ${SSE_mail} - Элетронная почта
//    
//    ${SSE_accn} - Номер счёта
//    ${SSE_babik} - БИК банка
//    ${SSE_ban} - Наименование банка
//    ${SSE_ccn} - Номер карты
//Данные об клиенте (RJVE)		- SCL
//    ${SCL_cn} - название организации
//    ${SCL_ln} - Фамилия арендатора другие падежи
//    ${SCL_fn} - Имя арендатора другие падежи
//    ${SCL_sn} - Отчество арендатора другие падежи
//    ${SCL_fns} - Сокращенная форма ФИО (Иванов И.И.)
//    ${SCL_bd} - Дата рождения арендатора
//    ${SCL_bp} - Место рождения арендатора
//    ${SCL_pasn} - Серия и номер паспорта арендатора
//    ${SCL_pash} - Кем выдан паспорт
//    ${SCL_pasd} - Дата выдачи паспорта
//    ${SCL_pasc} - Код подразделения паспорта
//    ${SCL_regaddr} - Адрес регистрации арендатора
//    ${SCL_addr} - Место жительства арендатора
//    ${SCL_lisn} - Серия и номер водительского удостоверения арендатора
//    ${SCL_lish} - Кем выдано водительское удостоверение
//    ${SCL_lisd} - Дата выдачи водительского удостоверения
//    ${SCL_phone} - Номер телефона Арендатора
//    ${SCL_mail} - Элетронная почта арендатора
//    ${SCL_accn} - Номер счёта арендатора
//    ${SCL_babik} - БИК банка арендатора
//    ${SCL_ban} - Наименование банка арендатора
//    ${SCL_ccn} - Номер карты арендатора
//Данные о договоре			- CON
//Данные об автомобиле		- CAR
//   
//   
//	
//    
//    ${CAR_Power}		- Мощность двигателя
//
//    
//	${CAR_STSd}	- дата выдачи СТС (дата выдачи из самого свежего события Рег. действия)
//    ${CAR_STSn}		- Серия и Номер СТС (номер документа из самого свежего события Рег. действия)
//    ${CAR_Col}		- Цвет автомобиля (цвет из самого свежего события Рег. действия)
//    ${CAR_PTSn}		- Серия и Номер ПТС (номер документа из самого свежего события ПТС)
//    ${CAR_OSAGOn}	- Серия и Номер полиса ОСАГО
    
    
    
    
    
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
                    $returnArray[$variable] = $contractObj->subjectFrom->actualEntity->fullName;
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
