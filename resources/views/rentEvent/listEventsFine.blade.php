@if($listEventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Машина</div>
        <div class="col-2">Оплата До</div>
        <div class="col-2">Скидка До</div>
        <div class="col-2">Сумма/Скидка</div>
        <div class="col-2"></div>
    </div>
    @foreach($listEventsObj as $event)
        <div class="row row-table">
            <div class="col-2">{{$event->dateTime->format('d-m-Y H:i')}}</div>
            <div class="col-2">{{$event->nickName}}</div>
            <div class="col-2">{{$event->datePayMax}}</div>
            <div class="col-2">{{$event->datePaySale}}</div>
            <div class="col-2">{{$event->sum}}/{{$event->sumSale}}</div>
            <div class="col-2">
                <form method="POST" action="/{{$eventObj->action}}/{{$event->dataId}}">
                    @method('DELETE')
                    @csrf
                    <a class="btn btn-ssm btn-outline-warning" href="/{{$eventObj->action}} /{{$event->dataId}}/edit" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <button class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить событие?')"><i class="fas fa-trash"></i> </button>
                </form>

            </div>
        </div>
    @endforeach

@endif
