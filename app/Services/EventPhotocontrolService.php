<?php
namespace App\Services;

use App\Repositories\EventPhotocontrolRepository;

use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Models\rentEvent;
use App\Models\timeSheet;
use App\Models\toPayment;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Http\Requests\Event;
use Illuminate\Support\Facades\DB;



Class EventPhotocontrolService implements EventServiceInterface{
    
    private $eventPhotocontrolRep,$timeSheetRep,$toPaymentRep,$eventObj,$contractRep;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventPhotocontrolRep = new EventPhotocontrolRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    
    
    public function index(CarbonPeriod $datePeriod)
    {
        
    }

    public function getAdditionalViewDataArray(){
        
    }

    public function getEventModel($modelId = null)
    {
        
    }

    public function store($dataCollection = null): timeSheet
    {
        
        if ($dataCollection){
            $eventPhotocontrolRequest = $dataCollection;
        } else {
            $eventPhotocontrolRequest = app()->make(Event\PhotocontrolRequest::class);
        }

        DB::beginTransaction();
        try {
        
            $eventPhotocontrolModel = $this->eventPhotocontrolRep->getEvent($eventPhotocontrolRequest->get('id'));
            $eventPhotocontrolModel->personId = $eventPhotocontrolRequest->get('subjectId');
            
            $eventPhotocontrolModel = $this->eventPhotocontrolRep->addEvent($eventPhotocontrolModel);
            
            $timeSheetModel = $this->timeSheetRep->getTimeSheetByEvent($this->eventObj,$eventPhotocontrolModel->id);
            $timeSheetModel->eventId = $this->eventObj->id;
            $timeSheetModel->dataId = $eventPhotocontrolModel->id;
            $timeSheetModel->dateTime = $eventPhotocontrolRequest->get('dateTime');
            $timeSheetModel->carId = $eventPhotocontrolRequest->get('carId');
            $timeSheetModel->duration = $this->eventObj->duration;
            $timeSheetModel->color = $this->eventObj->color;
            $timeSheetModel->pId =  $eventPhotocontrolRequest->get('parentId');
            $timeSheetModel->comment = $eventPhotocontrolRequest->get('comment');
            $timeSheetModel->mileage = $eventPhotocontrolRequest->get('mileage');

            $timeSheetModel = $this->timeSheetRep->addTimeSheet($timeSheetModel);
            
            
            DB::commit();
            return $timeSheetModel;
            
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
            exit();
        }
        
    }

    public function destroy($dataId){
        
    }

    public function getViews(){
        
    }

    public function getEventInfo($dataId = null)
    {
        return $this->eventPhotocontrolRep->getEventFullInfo($this->eventObj->id, $dataId);
    }
    
    public function getNearestEvent(Carbon $dateTime,$carId)
    {
        
    }
    
    

}
