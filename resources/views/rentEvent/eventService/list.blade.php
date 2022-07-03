@if($listEventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2"></div>
        <div class="col-2">Договор</div>
        <div class="col-2">Комментарий</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
    @foreach($listEventsObj as $event)
        <div class="row row-table">
            <div class="col-2">{{$event->dateTime->format('d-m-Y H:i')}}</div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2">
                <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$eventObj->id}}/{{$event->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                <button class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить событие?')"><i class="fas fa-trash"></i> </button>
            </div>
        </div>
    @endforeach

@endif
