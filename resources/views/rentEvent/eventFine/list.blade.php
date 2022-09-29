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
        <div class="row row-table" data-event="{{$eventObj->id}}" data-id="{{$event->id}}">
            <div class="col-2" title="{{$event->dateTime->format('H:i')}}">
                <a href="/rentEvent/{{$eventObj->id}}/{{$event->id ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->dateTime->toDateString()}}
            </div>
            <div class="col-2">
                <a href="/motorPool/carInfo/{{$event->carId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->carText}}
            </div>
            <div class="col-2">@if($event->datePayMax){{$event->datePayMax->toDateString()}} @endif</div>
            <div class="col-2">@if($event->datePaySale){{$event->datePaySale->toDateString()}} @endif</div>
            <div class="col-2">
                <div class="row">
                    <div class="col-5 text-right p-0">
                        {{$event->sum}} p.
                    </div>
                    <div class="col-1 text-center p-0">
                        /
                    </div>
                    <div class="col-5 text-right p-0">
                        {{$event->sumSale}} p.
                    </div>
                </div>
            </div>
            <div class="col-2 text-right">
                <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$eventObj->id}}/{{$event->id ?? 0}}/edit?needParent=1" title="Редактировать"><i class="far fa-edit"></i></a>
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
