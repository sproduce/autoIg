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
        <input type="number" name="parentId" id="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm">
                <label for="carText" title="Автомобиль">Машина</label>
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2" id="carClear"><i class="fas fa-eraser"></i></a>
                <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="date" title="Дата начала действия">Дата начала действия</label>
                <input type="date" name="date" id="date" class="form-control" value="{{old('date',$eventDataObj->date ? $eventDataObj->date->toDateString() : $dateTime->toDateString())}}"/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="expirationDate" title="Дата окончания действия">Дата окончания действия</label>
                <input type="date" name="expirationDate" id="expirationDate" value="{{old('expiration',$eventDataObj->expiration)}}" class="form-control" required/>
            </div>
        </div>

        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm">
                <label for="sum" title="Дата начала действия">Сумма</label>
                <input type="number" name="sum" id="sum" class="form-control" value="{{old('sum',$eventDataObj->sum)}}"/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="comment" title="Комменатрий">Комменатрий</label>
                <input type="text" name="comment" id="comment" value="{{old('comment',$eventDataObj->comment)}}" class="form-control"/>
            </div>
        </div>

    </form>
@endsection
