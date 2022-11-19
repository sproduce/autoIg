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
    protected $signature = 'gibdd:parse';

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

    
    private function parceExcelFile($fileName) 
    {
        $gibddFineRep = new \App\Repositories\GibddFineRepository();
        Excel::import(new GibddFineImport($gibddFineRep,$fileName),$fileName);

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
            $titleObj = $eventTitleServ->getEventInfoByNumber($fineObj->sts);
            if ($titleObj->carId){
                $this->info($titleObj->carId." (".$titleObj->carText.") ".$fineObj->dateDecree->format('d-m-Y')." ".$fineObj->dateTimeFine." ".$fineObj->decreeNumber." ".$fineObj->dateSale->format('d-m-Y')." ".$fineObj->sumSale." ".$fineObj->datePayMax->format('d-m-Y')." ".$fineObj->sum." add parse");
                $dataCollection = collect([
                    'dateOrder' => $fineObj->dateDecree->format('Y-m-d'),
                    'datePayMax' => $fineObj->datePayMax->format('Y-m-d'),
                    'datePaySale' => $fineObj->dateSale->format('Y-m-d'),
                    'dateTimeFine' => $fineObj->dateTimeFine,
                    'sum' => $fineObj->sum,
                    'sumSale' => $fineObj->sumSale,
                    'carId' => $titleObj->carId,
                    'uin' => $fineObj->decreeNumber,
                    'comment' => "Automat add",
                    'parentId' => null,
                ]);
                $timeSheetId = $eventFineServ->store($dataCollection);
                $fineObj->timeSheetId = $timeSheetId;
                $fineObj->save();
                $this->addChildFine($titleObj->carId, $timeSheetId, $fineObj->dateTimeFine,$fineObj->sumSale);
            }
        }

    }
    
    
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $storagePath = Storage::disk('fines')->path('');
        $this->info("Storage path ".$storagePath);
        $client = \Webklex\IMAP\Facades\Client::account('default');
        $client->connect();
        $folder = $client->getFolderByName('FINES');
            //$folder->messages()->setFetchOrderDesc();
        $query = $folder->messages();
        //$messages = $folder->messages()->setFetchOrderAsc()->all()->get();
        $messages = $query->unseen()->get();
        foreach ($messages as $message){
            $this->gibddFineServ->setFinesPaid();
            $attachments = $message->getAttachments();
            if (isset($attachments[0])){
                $attachments[0]->save($storagePath,null);
                $this->info("Parce file name ".$attachments[0]->getName());
                $this->parceExcelFile($storagePath.$attachments[0]->getName());
            }
            $message->setFlag('Seen');
        }

        $this->addFineEvent();
        
        
        return 0;
    }
}
