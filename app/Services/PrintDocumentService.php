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
//    ${SSE_cnfu} - полное название организации
//	${SSE_cnsh} - полное название организации
//	${SSE_inn} - ИНН организации
//	
//    ${SSE_ln} - Фамилия другие падежи
//    ${SSE_fn} - Имя другие падежи
//    ${SSE_sn} - Отчество другие падежи
//    ${SSE_fns} - Сокращенная форма ФИО (Иванов И.И.)
//	
//	${SSE_ogrn} - ОГРН
//	${SSE_inn} - ИНН
//	${SSE_uregaddr} - Адрес регистрации юр лица
//	
//    ${SSE_bd} - Дата рождения
//    ${SSE_bp} - Место рождения
//    ${SSE_pasn} - Серия и номер паспорта
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
//    ${CAR_Brand}		- Марка автомобиля (например: BMW) (из информации о автомобиле)
//    ${CAR_Model}		- Модель автомобиля (например: Z4) (из информации о автомобиле)
//	${CAR_VINn}		- VIN номер автомобиля (из информации о автомобиле)
//    ${CAR_Y}			- Год выпуска автомобиля  (из информации о автомобиле)
//    ${CAR_Power}		- Мощность двигателя
//
//    ${CAR_StNum}		- Регистрационный номер (У777УУ77) (Гос номер Рег. действия)
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
