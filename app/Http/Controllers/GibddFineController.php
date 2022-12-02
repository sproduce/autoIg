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
    private $gibddFineServ,$rentEventServ;
    
    public function __construct(GibddFineService $gibddFineServ,RentEventService $rentEventServ)
    {
        $this->gibddFineServ = $gibddFineServ;
        $this->rentEventServ = $rentEventServ;
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
        $carbonDateTime = new Carbon('2021-12-16 04:22');
        
        
        $result = $eventRentalServ->getNearestEvent($carbonDateTime, 11);
        
        
        $dateTimeStart = $result->dateTime;
        $dateTimeEnd = $result->dateTime->addMinute($result->duration);
        echo $result->duration;
        var_dump($dateTimeStart);
         var_dump($result->dateTime->addMinute($result->duration));
         exit();
        if ($carbonDateTime->between($dateTimeStart,$dateTimeEnd)){
            echo "!!!!!!!";
        }
        
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
    
    
    
    
    
    public function testAuto() 
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.onlinegibdd.ru/v3/partner_auto/");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".env('GIBDD_KEY')));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response_json = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $responseArray = json_decode($response_json,true);
        //var_dump($responseArray);
        foreach($responseArray['data'] as $car){
            $arrayRemoteCar[] = $car['auto_cdi'];
        }
        
        $eventTitleObj = $this->rentEventServ->getRentEvent(config('rentEvent.eventTitle'));
        $eventTitleServ = $this->rentEventServ->getEventService($eventTitleObj);
        
        $arrayLocalCar = $eventTitleServ->getNumbers();
        
        //var_dump($arrayRemoteCar);
        
        //var_dump($arrayLocalCar);
        echo "Отсутствуют в системе<br/>";
        $diffRemote = array_diff($arrayRemoteCar,$arrayLocalCar);
        foreach($diffRemote as $remoteNumber){
            echo $remoteNumber."<br/>";
        }
        
        echo "<br/>Отсутствуют в API<br/>";
        $diffLocal = array_diff($arrayLocalCar,$arrayRemoteCar);
        foreach($diffLocal as $localNumber){
            echo $localNumber."<br/>";
        }
        
        
        //var_dump($diffLocal);
        
        exit();
    }
    
    public function test1() 
    {
//echo config('rentEvent.eventFineChild');
        
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, "https://api.onlinegibdd.ru/v3/partner_fines/");
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".env('GIBDD_KEY'), "Content-Type: application/json"));
//        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"status":"all","autos_ids":"1346848,1321925"}');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $response_json = curl_exec($ch);
//        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//        curl_close($ch);
//        $responseArray = json_decode($response_json,true);
//        var_dump($responseArray);

        exit();
    }
    
    
    
}
