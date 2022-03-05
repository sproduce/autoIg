@if($eventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Машина</div>
        <div class="col-2">Тип</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2">Комментарий</div>
    </div>
    @foreach($eventsObj as $event)
        <div class="row row-table">
            <div class="col-2">{{$event->dateTime->format('d-m-Y H:i')}}</div>
            <div class="col-2">{{$event->nickName}}</div>
            <div class="col-2">
                @if($event->type)
                        Прием
                    @else
                    Передача
                @endif
            </div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2">{{$event->comment}}</div>
        </div>
    @endforeach

@endif
