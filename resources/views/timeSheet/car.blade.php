@extends('../adminIndex')

@php

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить событие" href="/timesheet/add?carId={{$carObj->id}}"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0 mr-3">События машины {{$carObj->nickName}}</h6>
@endsection


@section('content')
    <form type="GET" action="">
        <input name="carId" value="{{$carObj->id}}" hidden/>
        <div class="row text-center">
            <div class="form-group col-md-2 input-group-sm">
                <input class="form-control" type="date" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input class="form-control" type="date" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input type="submit" class="btn btn-sm btn-success" value="Показать"/>
            </div>
        </div>
    </form>

    @if($timeSheetsObj->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">Событие</div>
            <div class="col-2">Дата</div>
            <div class="col-1">Прод.</div>
            <div class="col-1">Сумма</div>
            <div class="col-1">Пробег</div>
            <div class="col-1">Договор</div>
            <div class="col-2">Комментарий</div>
        </div>



        @foreach($timeSheetsObj as $timeSheet)
            <div class="row row-table">
                <div class="col-3" style="background-color:{{$timeSheet->event->color}}">{{$timeSheet->event->name}}</div>
                <div class="col-2">{{$timeSheet->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-1">{{round($timeSheet->duration/60)}}</div>
                <div class="col-1">{{$timeSheet->toPayment->sum}}</div>
                <div class="col-1">{{$timeSheet->mileage}}</div>
                <div class="col-1"></div>
                <div class="col-2">{{$timeSheet->comment}}</div>
            </div>
        @endforeach



        <div class="row align-items-center font-weight-bold border mt-5">
            <div class="col-3">Событие</div>
            <div class="col-3">Начало</div>
            <div class="col-3">Завершение</div>
            <div class="col-2">Сумма</div>
        </div>
        @foreach($timeSheetSpan as $span)
            <div class="row row-table">
                <div class="col-3">{{$span->event->name}}</div>
                <div class="col-3">{{$span->fromDate->format('d-m-Y H:i')}}</div>
                <div class="col-3">{{$span->toDate->format('d-m-Y H:i')}}</div>
                <div class="col-2"></div>
            </div>
        @endforeach
        @else
        За выбранный период событий не найдено
    @endif



@endsection


@section('js')

@endsection


