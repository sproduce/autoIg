<div class="row row-table @if($event->deleted_at)deleteLine @endif" data-event="{{$event->eventId}}" data-id="{{$event->dataId}}">
    @include("rentEvent.generalLine")  
    <div class="col-3">
        {{$event->timeSheetObj->dateTime->format("d-m-y H:i")}} <strong>-</strong> {{$event->timeSheetObj->dateTime->addMinute($event->timeSheetObj->duration-1)->format("d-m-y H:i")}} ({{$event->eventFullInfo->durationHours}})
    </div>
    <div class="col-1 text-right pr-0">
        <a href="/file/fileInfoDialog/{{$event->eventFullInfo->uuid}}" class="btn btn-ssm @if($event->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
        @if(!$event->timeSheetObj->deleted_at)
            <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->timeSheetObj->eventId}}/{{$event->timeSheetObj->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
            <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
        @endif
    </div>
</div>