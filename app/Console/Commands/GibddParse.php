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

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    
    private function parceExcelFile($fileName) 
    {
        $gibddFineRep = new \App\Repositories\GibddFineRepository();
        Excel::import(new GibddFineImport($gibddFineRep,$fileName),$fileName);
        
        
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
        return 0;
    }
}
