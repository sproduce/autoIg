<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GibddFineService;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GibddFineImport;



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

    private $gibddServ,$fineServ;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GibddFineService $gibddServ, \App\Services\EventFineService $fineServ)
    {
        parent::__construct();
        $this->gibddServ = $gibddServ;
        $this->fineServ = $fineServ;
                
    }

    
    private function parceExcelFile($fileName) 
    {
        $gibddFineRep = new \App\Repositories\GibddFineRepository();
        Excel::import(new GibddFineImport($gibddFineRep,$fileName),$fileName);

    }
    
        
    private function addFineEvent()
    {
        $finesObj = $this->gibddServ->getFinesWithoutOfTimeSheet();
        $this->info($finesObj->count());
        $this->info("Get Fine Out timeSheet ");
    }
    
    
    
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(GibddFineService $gibddFineServ)
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
