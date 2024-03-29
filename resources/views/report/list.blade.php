@extends('../adminIndex')

@section('header')
 <form method="GET" action="" class="w-100">
        <div class="row">   
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <select id="eventSelect">
                    <option value="0">Событие</option>
                    @foreach($eventsObj as $eventObj)
                        <option value="{{$eventObj->id}}">{{$eventObj->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-1 input-group-sm">
                <button class="btn btn-sm btn-success" type="submit">Отчет</button>
            </div>
        </div>
    </form>
@endsection



@section('content')
 

    @foreach($timeSheets as $timeSheet)
        <div class="row">
            <div class="col-2">{{$timeSheet->event->name}}</div>
            <div class="col-2">{{$timeSheet->car->nickName}}</div>
        </div>

    @endforeach
@endsection


@section('js')
  
@endsection


