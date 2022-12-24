<div class="row row-table @if($event->deleted_at)deleteLine @endif" data-event="{{$event->eventId}}" data-id="{{$event->dataId}}">
            <div class="col-1 text-right p-0">
                <a href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->dateTime->format("d-m-y")}} {{$event->dateTime->format("H:i")}}
            </div>
            <div class="col-2">
                <a href="/motorPool/carInfo/{{$event->carId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->carNickName}}
            </div>
     <div class="col-1">
        @if($event->eventFullInfo->contractId)
            <a href="/contract/contractInfo/{{$event->eventFullInfo->contractId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
            {{$event->eventFullInfo->contractNumber}}
        @endif
    </div>
            <div class="col-1">
                {{$event->eventObj->name}}
            </div>
            <div class="col-1 p-0">
                {{$event->toPaymentSum}}p./{{$event->toPaymentPaymentSum}}p.
                
            </div>
            <div class="col-2">
                {{$event->comment}}
            </div>            
    <div class="col-3" title="Пост. от: {{$event->eventFullInfo->dateTimeOrder->format('d-m-y')}}">
                <strong>УИН</strong> {{$event->eventFullInfo->uin}} 
                <strong>Опл.До:</strong> {{$event->eventFullInfo->datePayMax->format('d-m-y')}}
            </div>            
    
        
    
            <div class="col-1 text-right pr-0">
                <a href="/file/fileInfoDialog/{{$event->eventFullInfo->uuid}}" class="btn btn-ssm @if($event->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                
                @if(!$event->deleted_at)
                    <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
                @endif
            </div>

        </div>