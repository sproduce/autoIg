@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')


@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}">
    @csrf
        <input type="number" name="id" id="id" value="{{old('id',$eventDataObj->id)}}" hidden/>

        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm">
                <label for="carText" title="Автомобиль">Машина</label>
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2" id="carClear"><i class="fas fa-eraser"></i></a>
                <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="date" title="Дата постановки на учет">Дата постановки на учет</label>
                <input type="date" name="date" id="date" class="form-control" value="{{old('date',$eventDataObj->dateTime ? $eventDataObj->dateTime->toDateString() : $dateTime->toDateString())}}"/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="sum" title="Сумма">Сумма</label>
                <input type="number" name="sum" id="sum" value="{{old('sum')}}" class="form-control" required/>
            </div>
        </div>


        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm">
                <label for="regNumber" title="Регистрационный знак">Регистрационный знак</label>
                <input type="text" name="regNumber" id="regNumber" value="{{old('regNumber')}}" class="form-control" required/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="number" title="Номер СТС">Номер СТС</label>
                <input type="text" name="number" id="number" value="{{old('number')}}" class="form-control" required/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="passport" title="Номер ПТС">Номер ПТС</label>
                <input type="text" name="passport" id="passport" value="{{old('passport')}}" class="form-control" required/>
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
