@if($listEventsObj->count())

    <div class="row align-items-center font-weight-bold border">

    </div>
    @foreach($listEventsObj as $event)
        <div class="row row-table">

            <div class="col-2">
                <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$eventObj->id}}/{{$event->dataId ?? 0}}/edit" title="Редактировать"> <i class="far fa-edit"></i></a>
                <button class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить событие?')"><i class="fas fa-trash"></i> </button>
            </div>
        </div>
    @endforeach

@endif
