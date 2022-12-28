<div class="row row-table @if($event->deleted_at)deleteLine @endif" data-event="{{$event->eventId}}" data-id="{{$event->dataId}}">
        @include("rentEvent.generalLine")  
    <div class="col-3">
        <strong>№ </strong> {{$event->eventFullInfo->number}}
        <strong>От:</strong> {{$event->eventFullInfo->dateDocument->format('d-m-Y')}} <strong>-</strong> {{$event->eventFullInfo->expiration->format('d-m-Y')}}
    </div>        

        

    <div class="col-1 text-right pr-0">
        <a href="/file/fileInfoDialog/{{$event->eventFullInfo->uuid}}" class="btn btn-ssm @if($event->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
        @if(!$event->deleted_at)
            <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
            <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
        @endif
    </div>
</div>