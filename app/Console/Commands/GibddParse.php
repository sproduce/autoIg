<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GibddFineService;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GibddFineImport;
use App\Services\RentEventService;

use Carbon\Carbon;


class GibddParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gibdd:parse {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $gibddFineServ,$rentEventServ;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GibddFineService $gibddServ, RentEventService $rentEvetServ)
    {
        parent::__construct();
        $this->gibddFineServ = $gibddServ;
        $this->rentEventServ = $rentEvetServ;
        
    }

     
    
    private function addChildFine($carId,$timeSheetId,$dateTime,$sum)
    {
        $eventRentalObj = $this->rentEventServ->getRentEvent(2);
        $eventGeneralObj = $this->rentEventServ->getRentEvent(17);
        
        $eventRentalServ = $this->rentEventServ->getEventService($eventRentalObj);
        $eventGeneralServ = $this->rentEventServ->getEventService($eventGeneralObj);
        
        $nearestRental = $eventRentalServ->getNearestEvent($dateTime, $carId);
        
        if ($nearestRental){

            $dateTimeStart = $nearestRental->dateTime;
            $dateTimeEnd = $nearestRental->dateTime->clone()->addMinute($nearestRental->duration);

            if ($dateTime->between($dateTimeStart,$dateTimeEnd)){
                $this->info("Id rental ".$nearestRental->id);
                $dataCollection = collect([
                    'contractId' => $nearestRental->contractId,
                    'sum' => $sum,
                    'comment' => "Automat add",
                    'dateTime' => $dateTime,
                    'parentId' => $timeSheetId,
                    ]);
                $eventGeneralServ->store($dataCollection);    
            }
        }
    }
    
    
    
    
    private function addFineEvent()
    {
        $eventTitleObj = $this->rentEventServ->getRentEvent(16);
        $eventFineObj = $this->rentEventServ->getRentEvent(1);

        
        $eventTitleServ = $this->rentEventServ->getEventService($eventTitleObj);
        $eventFineServ = $this->rentEventServ->getEventService($eventFineObj);
        
        $finesObj = $this->gibddFineServ->getFinesWithoutOfTimeSheet();
        //$this->info($finesObj->count());
        foreach ($finesObj as $fineObj){
            echo $fineObj->id;
            $titleObj = $eventTitleServ->getEventInfoByNumber($fineObj->sts);
            if ($titleObj->carId){
                //$this->info($titleObj->carId." (".$titleObj->carText.") ".$fineObj->dateDecree->format('d-m-Y')." ".$fineObj->dateTimeFine." ".$fineObj->decreeNumber." ".$fineObj->dateSale->format('d-m-Y')." ".$fineObj->sumSale." ".$fineObj->datePayMax->format('d-m-Y')." ".$fineObj->sum." add parse");
                $dataCollection = collect([
                    'dateOrder' => $fineObj->dateDecree->format('Y-m-d'),
                    'datePayMax' => $fineObj->datePayMax->format('Y-m-d'),
                    'datePaySale' => ($fineObj->dateSale ? $fineObj->dateSale: null),
                    'dateTimeFine' => $fineObj->dateTimeFine,
                    'sum' => $fineObj->sum,
                    'sumSale' => $fineObj->sumSale,
                    'carId' => $titleObj->carId,
                    'uin' => $fineObj->decreeNumber,
                    'comment' => "Automat add",
                    'parentId' => null,
                ]);
                $timeSheetObj = $eventFineServ->store($dataCollection);
                $fineObj->timeSheetId = $timeSheetObj->id;
                $fineObj->save();
                $this->addChildFine($titleObj->carId, $timeSheetObj->id, $fineObj->dateTimeFine,($fineObj->sumSale?$fineObj->sumSale:$fineObj->sum));
            }
        }
    }
    
    
    
    private function storeFine($carInfo,$fines)
    {
        foreach($fines as $fine){
            //var_dump($fine);
            $gibddFineObj = $this->gibddFineServ->getFineByNumber($fine['bill_id']);
            if (!$gibddFineObj->id){
                $gibddFineObj->dateFile = date('Y-m-d', strtotime("now"));
            }
            
            
            $gibddFineObj->sts = $carInfo['auto_cdi'];
            $gibddFineObj->regnumber = $carInfo['auto_number'].$carInfo['auto_region'];
            
            
            $gibddFineObj->decreeNumber = $fine['bill_id'];
            $gibddFineObj->dateDecree = $fine['pay_bill_date'];
            $gibddFineObj->sum = $fine['pay_bill_amount'];
            $gibddFineObj->datePayMax = $fine['last_bill_date'];
            
            //echo $fine['gis_discount_uptodate'];
            if ($fine['gis_discount']){
                $gibddFineObj->sumSale = $fine['pay_bill_amount_with_discount'];
                $gibddFineObj->dateSale = $fine['gis_discount_uptodate'];
                $gibddFineObj->sale = $fine['gis_discount'];
            }
            
            $gibddFineObj->unit = $fine['gis_podrazdelenie'];
            $gibddFineObj->receiver = $fine['gis_send_to'];
            $gibddFineObj->inn = $fine['gis_inn'];
            $gibddFineObj->kpp = $fine['gis_kpp'];
            $gibddFineObj->bik = $fine['gis_bik'];
            
            $gibddFineObj->kbk = $fine['gis_kbk'];
            $gibddFineObj->okato = $fine['gis_wireoktmo'];
            $gibddFineObj->bankReceiver = $fine['gis_bank'];
            $gibddFineObj->accountReceiver = $fine['gis_bank'];
            if ($fine['offense_date']){
                $gibddFineObj->dateTimeFine = date('Y-m-d H:i',strtotime($fine['offense_date']." ".$fine['offense_time']));
            } else {
                $gibddFineObj->dateTimeFine = null;
            }
            
            
            $gibddFineObj->place = $fine['offense_location'];
            $gibddFineObj->koap = $fine['offense_article_number']." ".$fine['offense_article'];

            $gibddFineObj->entity = $fine['gis_podrazdelenie'];
            
            if ($fine['gis_status']=="nopayed"){
                $gibddFineObj->closed = 0;
                $gibddFineObj->dateFile = date('Y-m-d', strtotime("now"));
            } else {
                $gibddFineObj->closed = 1;
            }
            $gibddFineObj->save();
        }
        
    }
    
    
    
    
    private function getAllCar()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.onlinegibdd.ru/v3/partner_auto/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".env('GIBDD_KEY')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
//        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        echo $http_code;
        curl_close($ch);
        $responseArray = json_decode($response_json,true);
        return $responseArray;
    }
    
    
    
    private function getFinesByCar($apiCarId,$status)
    {//'{"status":"all","autos_ids":"1346848,1321925"}'
        $requestArray = ['status' => $status,'autos_ids' => $apiCarId];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.onlinegibdd.ru/v3/partner_fines/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".env('GIBDD_KEY'), "Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestArray));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($http_code==200){
            $responseArray = json_decode($response_json,true);
            if (isset($responseArray['data']['auto_list'][0]['offense_list'])){
                return $responseArray['data']['auto_list'][0]['offense_list'];
            }
            
        } 
            return null;
    }
    
    
    
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $allCarApi = $this->getAllCar();
        $this->gibddFineServ->setFinesPaid();        
        if ($this->option('all')){
            $statusFine = "all";
        } else {
            $statusFine = "nopayed";
        }
        
        foreach ($allCarApi['data'] as $carInfo){
            $carFines = $this->getFinesByCar($carInfo['id'],$statusFine);
            if ($carFines){
                $this->storeFine($carInfo, $carFines);
            }
            //var_dump($carFines);
            sleep(2);
        }
        $this->addFineEvent();
        
        return 0;
    }
}
