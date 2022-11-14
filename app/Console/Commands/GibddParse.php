<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GibddFineService;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GibddFineImport;
use App\Services\RentEventService;


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
    
        
    private function addFineEvent()
    {
        $eventTitleObj = $this->rentEventServ->getRentEvent(16);
        $eventFineObj = $this->rentEventServ->getRentEvent(1);
        
        $eventTitleServ = $this->rentEventServ->getEventService($eventTitleObj);
        $eventFineServ = $this->rentEventServ->getEventService($eventFineObj);
        
        $finesObj = $this->gibddFineServ->getFinesWithoutOfTimeSheet();
        $this->info($finesObj->count());
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
            }
        }
//        $this->fineServ->store();
//        $this->info($finesObj->count());
//        $this->info("Get Fine Out timeSheet ");
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
        $folders = $client->getFolders();
        foreach ($folders as $folder){
            if($folder->path == "FINES"){
                 $messages = $folder->messages()->all()->get();
                 foreach ($messages as $message){
                     $flags = $message->getFlags();
                     if ($flags->get('seen') != "Seen"){
                         $attachments = $message->getAttachments();
                         $attachments[0]->save($storagePath,null);
                         //echo  $storagePath.$attachments[0]->getName();
                         //var_dump($attachments);
                         //echo $flags->get('seen');
                         
                         $this->parceExcelFile($storagePath.$attachments[0]->getName());
                         //$message->setFlag('Seen');
                     }
                 }

            }
        }
        
        
        
        $this->addFineEvent();
        
        
        return 0;
    }
}
