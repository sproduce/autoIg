@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
<form method="POST" action="/rentEvent/{{$eventObj->id}}">
        <input type="number" name="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
        <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
    @csrf
    <input name="eventId" value="{{$eventObj->id}}" hidden/>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                <input id="carText" name="carText" class="form-control" value="{{old('carTextOther',$eventDataObj->carTextOther ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carId" class="form-control" value="{{old('carIdOther',$eventDataObj->carIdOther ?? $carObj->id)}}" hidden/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="subjectText" title="Субьект">Субьект</label>
            <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2" id="subjectClear"><i class="fas fa-eraser"></i></a>
            <input id="subjectText" name="subjectText" value="{{old('subjectText',$eventDataObj->subjectNickname)}}" class="form-control"  readonly/>
            <input name="subjectId" id="subjectId" value="{{old('subjectId',$eventDataObj->subjectId)}}" hidden/>
        </div>
    </div>

    

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="date" title="Дата фотографии">Дата фотографии</label>
            <input type="date" name="date" id="date" class="form-control" value="{{$dateTime->toDateString()}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="time" title="Время">Время</label>
            <input type="time" name="time" id="time" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control"/>
        </div>
    </div>


    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Фотографии">Комментарий</label>
            <input type="text" name="comment" id="comment" class="form-control">
        </div>
    </div>


     <div class="form-row text-center">
        <div class="form-group col-md-4 input-group-sm">
            <label for="file" title="Файлы">Добавить файлы</label>
            <input type="file" multiple="true" name="file[]" accept="image/*" class="form-control-file" id="file">
        </div>
    </div>


    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
@endsection
