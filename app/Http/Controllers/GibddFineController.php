<?php

namespace App\Http\Controllers;
use App\Services\GibddFineService;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\GibddFineImport;

use Carbon\Carbon;



use App\Services\RentEventService;


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
    
    
    
    
    public function test(RentEventService $rentEventServ) 
    {
        $eventRentalObj = $rentEventServ->getRentEvent(2);
        $eventRentalServ = $rentEventServ->getEventService($eventRentalObj);
        $carbonDateTime = new Carbon('2021-12-16 04:22',11);
        
        
        $result = $eventRentalServ->getNearestEvent($carbonDateTime, 11);
      var_dump($result);
//        $finesObj = $this->gibddFineServ->getFinesWithoutOfTimeSheet();
//         foreach ($finesObj as $fineObj){
//            echo $fineObj->sts."<br/>";
//        }
//        echo "test";
        //$request->all() + [''];
        //$eventFineServ = new \App\Services\EventFineService();
        //$eventFineServ->store();
        
    }
}
