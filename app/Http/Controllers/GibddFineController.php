<?php

namespace App\Http\Controllers;
use App\Services\GibddFineService;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GibddFineImport;

class GibddFineController extends Controller
{
    private $gibddFineServ;
    
    public function __construct(GibddFineService $gibddFineServ)
    {
        $this->gibddFineServ = $gibddFineServ;
    }
    
    
    public function index() 
    {
        $finesObj = $this->gibddFineServ->getActualFines();
        return view('gibddFine.listAll',['finesObj' => $finesObj]);
    }
    
    
    
    public function parceExcelFile($fileName) 
    {
        $gibddFineRep = new \App\Repositories\GibddFineRepository();
        Excel::import(new GibddFineImport($gibddFineRep,$fileName),$fileName);
        
        
    }
    
    
    
    
    
    public function mail() 
    {
        $storagePath = Storage::disk('fines')->path('');
        
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
                         $message->setFlag('Seen');
                         //echo "<br/>";
                     }
                 }

            }
        }
        return redirect('/gibddfine');
    }
    
    
    
    
    public function test(\Illuminate\Http\Request $request) 
    {
        $request->all() + [''];
        $eventFineServ = new \App\Services\EventFineService();
        //$eventFineServ->store();
        
    }
}
