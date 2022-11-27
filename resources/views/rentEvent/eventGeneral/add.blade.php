@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center" enctype="multipart/form-data">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}">
        <input type="number" name="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
        <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор"> Договор </label>
            <a href="/contract/addContractTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            <input id="contractText" name="contractText" value="{{old('contractText',$eventDataObj->contractNumber ?? $contractObj->number)}}"  class="form-control" readonly />
            <input name="contractId" id="contractId" value="{{old('contractId',$eventDataObj->contractId ?? $contractObj->id)}}" hidden/>
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
            <input type="time" name="time" id="time" class="form-control" value="{{old('time',$eventDataObj->dateTime ? $eventDataObj->dateTime->format('H:i') : $dateTime->format('H:i'))}}"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
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
