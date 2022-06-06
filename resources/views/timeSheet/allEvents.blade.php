@extends('../adminIndex')

@php

@endphp
@section('header')
    <form method="GET" action="">
        <div class="d-flex flex-row">
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <button class="btn btn-sm btn-success" type="submit">Показать</button>
            </div>
        </div>
    </form>
@endsection


@section('content')
    <div class="row align-items-center font-weight-bold border">
        <div class="col-3 text-center">
            Дата
        </div>
        <div class="col-3">
            Событие
        </div>
        <div class="col-3">
            Машина
        </div>
        <div class="col-3">
            Комментарий
        </div>
    </div>

    @foreach($eventsArray as $event)
        <div class="row row-table">
            <div class="col-3">
                {{$event->dateTime->format('d-m-Y H:i')}}
            </div>
            <div class="col-3">
                {{$event->eventName}}
            </div>
            <div class="col-3">
                {{$event->carNickName}}
            </div>
            <div class="col-3">
                {{$event->comment}}
            </div>

        </div>
    @endforeach
@endsection


@section('js')

@endsection


