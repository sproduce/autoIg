<?php
namespace App\Services;


use App\Models\rentEvent;
use App\Http\Requests\Event;
use App\Repositories\EventDocumentInsuranceRepository;
use App\Repositories\EventOtherRepository;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;


Class EventDocumentInsuranceService implements EventServiceInterface{

    private $timeSheetRep,$toPaymentRep,$eventObj,$contractRep,$eventDocumentInsurance;

    function __construct(
        ContractRepositoryInterface $contractRep,
        TimeSheetRepositoryInterface $timeSheetRep,
        ToPaymentRepositoryInterface $toPaymentRep,
        rentEvent $eventObj
    ){
        $this->contractRep = $contractRep;
        $this->eventDocumentInsurance = new EventDocumentInsuranceRepository();
        $this->timeSheetRep = $timeSheetRep;
        $this->toPaymentRep = $toPaymentRep;
        $this->eventObj = $eventObj;
    }

    public function index(CarbonPeriod $datePeriod)
    {

    }

    public function getEventModel($modelId = null)
    {

    }


    public function getEventInfo($dataId = null)
    {
        return $this->eventDocumentInsurance->getEventFullInfo($this->eventObj->id,$dataId);
    }

    public function getAdditionalViewDataArray()
    {

    }



    public function store()
    {
        $eventDocumentInsuranceRequest = app()->make(Event\DocumentInsuranceRequest::class);
        $eventTimeSheetRequest = app()->make(Event\TimeSheetRequest::class);

        DB::beginTransaction();
        try {




            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function getViews()
    {

    }

    public function destroy($dataId)
    {

    }


}
