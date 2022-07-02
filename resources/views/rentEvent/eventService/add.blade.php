@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
<form method="POST" action="/eventOther">
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="carClear"><i class="fas fa-eraser"></i></a>
            @if($carObj->id)
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" disabled />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden/>
            @else
                <input id="carText" class="form-control" value="" disabled />
                <input id="carId" name="carId" class="form-control" value="" hidden/>
            @endif
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="subjectText" title="Субьект">Субьект</label>
            <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="subjectClear"><i class="fas fa-eraser"></i></a>
            <input id="subjectText" name="subjectText" value="" class="form-control"  readonly/>
            <input name="subjectId" id="subjectId" value="" hidden/>
        </div>

    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="sumOther" title="Сумма">Сумма</label>
            <input type="number" name="sumOther" id="sumOther" class="form-control"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateOther" title="Дата события">Дата события</label>
            <input type="date" name="dateOther" id="dateOther" class="form-control" value="{{$dateTime->toDateString()}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timeOther" title="Время нарушения">Время события</label>
            <input type="time" name="timeOther" id="timeOther" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="commentOther" title="Комментарий">Комментарий</label>
            <input type="text" name="commentOther" id="commentOther" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
@endsection
