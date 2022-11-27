@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')


@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}" enctype="multipart/form-data">
    @csrf
        <input type="number" name="id" id="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
        <input type="number" name="parentId" id="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="carText" title="Автомобиль">Машина</label>
                <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton"><i class="fas fa-eraser"></i></a>
                <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="subjectText" title="Субьект">Субьект</label>
                <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton" id="subjectClear"><i class="fas fa-eraser"></i></a>
                <input id="subjectText" name="subjectText" value="{{old('subjectText',$eventDataObj->subjectNickname)}}" class="form-control"  readonly/>
                <input name="subjectId" id="subjectId" value="{{old('subjectId',$eventDataObj->subjectId)}}" hidden/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="date" title="Дата события">Дата события</label>
                <input type="date" name="date" id="date" class="form-control" value="{{old('date',$eventDataObj->date ? $eventDataObj->date->toDateString() : $dateTime->toDateString())}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="dateDocument" title="Дата выдачи">Дата выдачи</label>
                <input type="date" name="dateDocument" id="dateDocument" class="form-control" value="{{old('dateDocument',$eventDataObj->dateDocument ? $eventDataObj->dateDocument->toDateString() : '')}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="sum" title="Сумма">Сумма</label>
                <input type="number" name="sum" id="sum" value="{{old('sum',$eventDataObj->sum)}}" class="form-control" required/>
            </div>
        </div>


        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="subjectOwnerText" title="Субьект">Владелец</label>
                <a href="/subject/addSubjectTo/ownerSubject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton" id="subjectClear"><i class="fas fa-eraser"></i></a>
                <input id="ownerSubjectText" name="ownerSubjectText" value="{{old('ownerSubjectText',$eventDataObj->ownerSubjectNickname)}}" class="form-control"  readonly/>
                <input name="ownerSubjectId" id="ownerSubjectId" value="{{old('ownerSubjectId',$eventDataObj->ownerSubjectId)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="number" title="Номер СТС">Номер СТС</label>
                <input type="text" name="number" id="number" value="{{old('number',$eventDataObj->number)}}" class="form-control" required/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="regNumber" title="Регистрационный знак">Регистрационный знак</label>
                <input type="text" name="regNumber" id="regNumber" value="{{old('regNumber',$eventDataObj->regNumber)}}" class="form-control" required/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="color" title="Цвет">Цвет</label>
                <input type="text" name="color" id="color" value="{{old('color',$eventDataObj->color)}}" class="form-control" required/>
            </div>
        </div>
        
         <div class="form-row text-center">
            <div class="form-group col-md-4 input-group-sm">
                <label for="issued" title="Выдан">Выдан</label>
                <input type="text" name="issued" id="issued" value="{{old('issued',$eventDataObj->issued)}}" class="form-control" required/>
            </div>
            
            <div class="form-group col-md-4 input-group-sm">
                <label for="marks" title="Особые отметки">Особые отметки</label>
                <input type="text" name="marks" id="marks" value="{{old('marks',$eventDataObj->marks)}}" class="form-control"/>
            </div>
             <div class="form-group col-md-4 input-group-sm">
                <label for="comment" title="Комменатрий">Комменатрий</label>
                <input type="text" name="comment" id="comment" value="{{old('comment',$eventDataObj->comment)}}" class="form-control"/>
            </div>
        </div>
        
        <div class="form-row text-center">
            <div class="form-group col-md-4 input-group-sm">
                <label for="photo" title="Фотографии">Фотографии</label>
                <input type="file" multiple="true" name="photo[]" class="form-control-file" id="photo" required>
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
