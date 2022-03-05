@if($eventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Машина</div>
        <div class="col-2">Оплата До</div>
        <div class="col-2">Скидка До</div>
        <div class="col-2">Сумма/Скидка</div>
        <div class="col-2">Комментарий</div>
    </div>
    @foreach($eventsObj as $event)
        <div class="row row-table">
            <div class="col-2">{{$event->dateTime->format('d-m-Y H:i')}}</div>
            <div class="col-2">{{$event->nickName}}</div>
            <div class="col-2">{{$event->datePayMax}}</div>
            <div class="col-2">{{$event->datePaySale}}</div>
            <div class="col-2">{{$event->sum}}/{{$event->sumSale}}</div>
            <div class="col-2">{{$event->comment}}</div>
        </div>
    @endforeach

@endif
