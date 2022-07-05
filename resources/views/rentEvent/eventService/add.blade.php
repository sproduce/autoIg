@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
<form method="POST" action="/rentEvent/{{$eventObj->id}}">
    <input type="number" name="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="carText" title="Автомобиль">Машина</label>
            <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="carClear"><i class="fas fa-eraser"></i></a>
            <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly />
            <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="subjectText" title="Субьект">Субьект</label>
            <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="subjectClear"><i class="fas fa-eraser"></i></a>
            <input id="subjectText" name="subjectText" value="{{old('subjectText',$eventDataObj->subjectNickname)}}" class="form-control"  readonly/>
            <input name="subjectId" id="subjectId" value="{{old('subjectId',$eventDataObj->subjectId)}}" hidden/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор">Договор</label>
            <a href="/contract/addContractTo" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="subjectClear"><i class="fas fa-eraser"></i></a>
            <input id="contractText" name="contractText" value="{{old('contractText',$eventDataObj->contractNumber ?? $contractObj->number)}}" class="form-control"  readonly/>
            <input name="contractId" id="contractId" value="{{old('subjectId',$eventDataObj->contractId ?? $contractObj->id)}}" hidden/>
        </div>

    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="sum" title="Сумма">Сумма</label>
            <input type="number" name="sum" id="sum" value="{{old('sum',$eventDataObj->sum)}}" class="form-control"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="date" title="Дата события">Дата события</label>
            <input type="date" name="date" id="date" class="form-control" value="{{old('date',$eventDataObj->dateTime ? $eventDataObj->dateTime->toDateString() : $dateTime->toDateString())}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="time" title="Время события">Время события</label>
            <input type="time" name="time" id="time" class="form-control" value="{{old('date', $eventDataObj->dateTime ? $eventDataObj->dateTime->format('H:i') : $dateTime->format('H:i'))}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" value="{{old('mileage',$eventDataObj->mileage)}}" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" value="{{old('comment',$eventDataObj->comment)}}" class="form-control"/>
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
