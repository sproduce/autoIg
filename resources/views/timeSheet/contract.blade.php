@extends('../adminIndex')

@php

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить событие" href="/timesheet/add?contractId={{$contractObj->id}}"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0 mr-3">События по контракту номер {{$contractObj->number}}</h6>
@endsection


@section('content')


    @if($timeSheetsObj->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">Событие</div>
            <div class="col-2">Дата</div>
            <div class="col-2">Продолж.</div>
            <div class="col-1">Сумма</div>
            <div class="col-1">Пробег</div>
            <div class="col-1">Машина</div>
            <div class="col-2"></div>
        </div>



        @foreach($timeSheetsObj as $timeSheet)
            <div class="row row-table">
                <div class="col-3" style="background-color:{{$timeSheet->event->color}}">{{$timeSheet->event->name}}</div>
                <div class="col-2" title="{{$timeSheet->comment}}">{{$timeSheet->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$timeSheet->duration}}</div>
                <div class="col-1">{{$timeSheet->sum}}</div>
                <div class="col-1">{{$timeSheet->mileage}}</div>
                <div class="col-1">{{$timeSheet->carId}}</div>
                <div class="col-2">
                    <a class="btn btn-ssm btn-outline-warning DialogUserMin" href="/timesheet/edit?timeSheetId={{$timeSheet->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                </div>
            </div>
        @endforeach
        @else
        По контракту событий не найдено
    @endif



@endsection


@section('js')

@endsection


