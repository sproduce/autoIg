@if($listEventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Машина</div>
        <div class="col-1">Сумма</div>
        <div class="col-3">Комментарий</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
    @foreach($listEventsObj as $event)
        <div class="row row-table" data-event="{{$eventObj->id}}" data-id="{{$event->id}}">
            <div class="col-2">{{$event->dateTime->format('d-m-Y H:i')}}</div>
            <div class="col-2">{{$event->carText}}</div>
            <div class="col-1 text-right">{{$event->sum}} p.</div>
            <div class="col-3">{{$event->comment}}</div>
            <div class="col-2"></div>
            <div class="col-2"><a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$eventObj->id}}/{{$event->id ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
            </div>
        </div>
    @endforeach

    <script>
        $(".deleteButton").click(function(){
            deleteEvent(this);
        });
    </script>



@endif
