<div class="col-1 text-right p-0">
        <a href="/rentEvent/{{$event->timeSheetObj->eventId}}/{{$event->timeSheetObj->dataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
        {{$event->timeSheetObj->dateTime->format("d-m-y")}} {{$event->timeSheetObj->dateTime->format("H:i")}}
    </div>
    <div class="col-2">
        @if($event->timeSheetObj->carId)
            <a href="/motorPool/carInfo/{{$event->timeSheetObj->carId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->timeSheetObj->car->nickName}}
        @endif
    </div>
    <div class="col-1">
        @if($event->eventFullInfo->contractId)
            <a href="/contract/contractInfo/{{$event->eventFullInfo->contractId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
            <a href="/contract/contractFullInfo/{{$event->eventFullInfo->contractId}}">{{$event->eventFullInfo->contractNumber}}</a>
            {{$event->contractFullInfo->car->nickName}} {{$event->contractFullInfo->subjectTo->nickname}}
        @endif
    </div>
    <div class="col-1" style="background-color:{{$event->eventObj->color}}">
        {{$event->eventObj->name}}
    </div>
    <div class="col-1 p-0" style="background-color:{{$event->color}}">
        {{$event->toPaymentSum}}p./{{$event->toPaymentPaymentSum}}p.
    </div>
    <div class="col-2">
        {{$event->timeSheetObj->comment}}
    </div>        