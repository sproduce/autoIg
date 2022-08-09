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
                <label for="regNumber" title="Регистрационный знак">Регистрационный знак</label>
                <input type="text" name="regNumber" id="regNumber" value="{{old('regNumber')}}" class="form-control" required/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="dateFine" title="Дата нарушения">Дата нарушения</label>
                <input type="date" name="dateFine" id="dateFine" class="form-control" value="{{old('dateFine',$eventDataObj->dateTimeFine ? $eventDataObj->dateTimeFine->toDateString() : $dateTime->toDateString())}}"/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="timeFine" title="Время нарушения">Время нарушения</label>
                <input type="time" name="timeFine" id="timeFine" class="form-control" value="{{old('timeFine',$eventDataObj->dateTimeFine ? $eventDataObj->dateTimeFine->format('H:i') : $dateTime->format('H:i'))}}"/>
            </div>
        </div>

    </form>
@endsection
