@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')


@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}">
    @csrf

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">
                Машина
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="carText" name="carTextOther" class="form-control" value="{{old('carTextOther',$eventDataObj->carTextOther ?? $carObj->nickName)}}" readonly />
            <input id="carIdOther" name="carIdOther" class="form-control" value="{{old('carIdOther',$eventDataObj->carIdOther ?? $carObj->id)}}" hidden/>
        </div>
    </div>


    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateOrder" title="Дата постановления">Дата постановления</label>
            <input type="date" name="dateOrder" id="dateOrder" value="{{old('dateOrder',$eventDataObj->dateTimeOrder ? $eventDataObj->dateTimeOrder->toDateString() : '')}}" class="form-control" required/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateFine" title="Дата нарушения">Дата нарушения</label>
            <input type="date" name="dateFine" id="dateFine" class="form-control" value="{{old('dateFine',$eventDataObj->dateTimeFine ? $eventDataObj->dateTimeFine->toDateString() : $dateTime->toDateString())}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeFine" title="Время нарушения">Время нарушения</label>
            <input type="time" name="timeFine" id="timeFine" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="uin" title="УИН номер">УИН номер</label>
            <input type="text" name="uin" id="uin" value="{{$eventDataObj->uin}}" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePaySale" title="Срок оплаты со скидкой">Срок оплаты со скидкой</label>
            <input type="date" name="datePaySale" id="datePaySale" class="form-control"
                   @if ($eventDataObj->datePaySale)
                       value="{{$eventDataObj->datePaySale->toDateString()}}"
                @endif
            />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePayMax" title="Максимальный срок оплаты">Максимальный срок оплаты</label>
            <input type="date" name="datePayMax" id="datePayMax" class="form-control"
                   @if ($eventDataObj->datePayMax)
                       value="{{$eventDataObj->datePayMax->toDateString()}}"
                @endif
            />
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="sumSale" title="Сумма штрафа со скидкой">Сумма штрафа со скидкой</label>
            <input type="number" name="sumSale" id="sumSale" value="{{$eventDataObj->sumSale}}" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="sum" title="Сумма штрафа">Сумма штрафа</label>
            <input type="number" name="sum" id="sum" value="{{$eventDataObj->sum}}" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" value="{{old('comment',$eventDataObj->commentSheet)}}" class="form-control"/>
        </div>
    </div>
    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            @if ($eventDataObj->id)
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
                @else
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
            @endif

        </div>
    </div>
</form>
@endsection
