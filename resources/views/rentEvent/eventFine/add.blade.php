@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')


@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')

    @if ($eventFineObj->id)
        <form method="POST" action="/eventFine/{{$eventFineObj->id}}">
        <input name="id" value="{{$eventFineObj->id}}" hidden/>
            @method('PUT')
        @else
        <form method="POST" action="/eventFine">
    @endif
    @csrf


    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">
                Машина
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" disabled />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden />
        </div>
    </div>


    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateOrder" title="Дата постановления">Дата постановления</label>
            <input type="date" name="dateOrder" id="dateOrder" class="form-control"
                   @if ($eventFineObj->dateTimeOrder)
                        value="{{$eventFineObj->dateTimeOrder->toDateString()}}"
                   @endif
                   required/>

        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateFine" title="Дата нарушения">Дата нарушения</label>
            <input type="date" name="dateFine" id="dateFine" class="form-control" value="{{$dateTime->toDateString()}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeFine" title="Время нарушения">Время нарушения</label>
            <input type="time" name="timeFine" id="timeFine" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="uin" title="УИН номер">УИН номер</label>
            <input type="text" name="uin" id="uin" value="{{$eventFineObj->uin}}" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePaySale" title="Срок оплаты со скидкой">Срок оплаты со скидкой</label>
            <input type="date" name="datePaySale" id="datePaySale" class="form-control"
                   @if ($eventFineObj->datePaySale)
                       value="{{$eventFineObj->datePaySale->toDateString()}}"
                @endif
            />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePayMax" title="Максимальный срок оплаты">Максимальный срок оплаты</label>
            <input type="date" name="datePayMax" id="datePayMax" class="form-control"
                   @if ($eventFineObj->datePayMax)
                       value="{{$eventFineObj->datePayMax->toDateString()}}"
                @endif
            />
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="sumSale" title="Сумма штрафа со скидкой">Сумма штрафа со скидкой</label>
            <input type="number" name="sumSale" id="sumSale" value="{{$eventFineObj->sumSale}}" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="sum" title="Сумма штрафа">Сумма штрафа</label>
            <input type="number" name="sum" id="sum" value="{{$eventFineObj->sum}}" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" value="{{$eventFineObj->comment}}" class="form-control"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control" value=""/>
        </div>
    </div>
    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            @if ($eventFineObj->id)
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
                @else
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
            @endif

        </div>
    </div>
</form>
@endsection
