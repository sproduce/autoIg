@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}" enctype="multipart/form-data">
        <input type="number" name="idOther" value="{{old('idOther',$eventDataObj->idOther)}}" hidden/>
        <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm clearRow">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2 clearButton"><i class="fas fa-eraser"></i></a>
                <input id="carText" name="carTextOther" class="form-control" value="{{old('carTextOther',$eventDataObj->carTextOther ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carIdOther" class="form-control" value="{{old('carIdOther',$eventDataObj->carIdOther ?? $carObj->id)}}" hidden/>
        </div>
        <div class="form-group col-md-3 input-group-sm clearRow">
            <label for="contractText" title="Договор"> Договор </label>
            <a href="/contract/addContractTo" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
            <a class="btn btn-ssm btn-outline-danger ml-2 clearButton"><i class="fas fa-eraser"></i></a>
            <input id="contractText" name="contractTextOther" value="{{old('contractTextOther',$eventDataObj->contractNumberOther ?? $contractObj->number)}}"  class="form-control" readonly />
            <input name="contractIdOther" id="contractId" value="{{old('contractIdOther',$eventDataObj->contractIdOther ?? $contractObj->id)}}" hidden/>
        </div>

    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="sumOther" title="Сумма">Сумма</label>
            <input type="number" name="sumOther" id="sumOther" value="{{old('sumOther',$eventDataObj->sumOther)}}" class="form-control"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateOther" title="Дата события">Дата события</label>
            <input type="date" name="dateOther" id="dateOther" class="form-control" value="{{old('dateOther',$eventDataObj->dateTimeOther ? $eventDataObj->dateTimeOther->toDateString() : $dateTime->toDateString())}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timeOther" title="Время события">Время события</label>
            <input type="time" name="timeOther" id="timeOther" class="form-control" value="{{old('timeOther',$eventDataObj->dateTimeOther ? $eventDataObj->dateTimeOther->format('H:i') : $dateTime->format('H:i'))}}"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="commentOther" title="Комментарий">Комментарий</label>
            <input type="text" name="commentOther" id="commentOther" value="{{old('commentOther',$eventDataObj->commentOther)}}" class="form-control"/>
        </div>
    </div>

    @if (!$eventDataObj->id)
        @include("rentEvent.fileAdd")
    @endif   
        
    <div class="form-row text-center" id="last-row">
       @if ($eventDataObj->id)
            <div class="input-group col-1">
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
            </div>
            @else
                @include("rentEvent.buttonSubmit")
            @endif
    </div>
</form>
@endsection
