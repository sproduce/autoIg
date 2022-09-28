@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 text-center"><strong>Событие </strong>{{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}">
        <input type="number" name="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
        <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
        @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>

            <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly/>
            <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="date" title="Дата события">Дата события</label>
            <input type="date" name="date" id="date" class="form-control" step="any" value="{{old('date',$eventDataObj->dateTime ? $eventDataObj->dateTime->toDateString() : $dateTime->toDateString())}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="time" title="Время события">Время события</label>
            <input type="time" step="60" name="time" id="time" class="form-control" step="any" value="{{old('date', $eventDataObj->dateTime ? $eventDataObj->dateTime->format('H:i') : $dateTime->format('H:i'))}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control" value="{{old('mileage',$eventDataObj->mileage)}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="culprit" title="Виновник ДТП">Виновник ДТП</label>
            <select name="culprit" id="culprit"  class="form-control" >
                <option value="1" @if(old('culprit',$eventDataObj->culprit)==1) selected @endif>Водитель</option>
                <option value="0" @if(old('culprit',$eventDataObj->culprit)==0) selected @endif>3-я сторона</option>
            </select>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="sum" title="Сумма убытка">Сумма убытка</label>
            <input type="number" name="sum" id="sum" class="form-control" value="{{old('sum',$eventDataObj->sum)}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" class="form-control" value="{{old('comment',$eventDataObj->comment)}}"/>
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
