<div class="row row-table @if($event->timeSheetObj->deleted_at)deleteLine @endif" data-event="{{$event->timeSheetObj->eventId}}" data-id="{{$event->timeSheetObj->dataId}}">
    @include("rentEvent.generalLine")    
    <div class="col-3" title="Пост. от: {{$event->eventFullInfo->dateTimeOrder->format('d-m-y')}}">
        <strong>УИН</strong> {{$event->eventFullInfo->uin}} 
        <strong>Опл.До:</strong> {{$event->eventFullInfo->datePayMax->format('d-m-y')}}
    </div>            

    <div class="col-1 text-right pr-0">
        <a href="/file/fileInfoDialog/{{$event->eventFullInfo->uuid}}" class="btn btn-ssm @if($event->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
           @if(!$event->timeSheetObj->deleted_at)
                <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->timeSheetObj->eventId}}/{{$event->timeSheetObj->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
            @endif
    </div>
</div>