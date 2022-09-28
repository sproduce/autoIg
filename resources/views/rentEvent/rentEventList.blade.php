@extends('../adminIndex')

@php

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3 DialogUserMin" title="Добавить событие" href="/rentEvent/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0 mr-3">События</h6>
@endsection


@section('content')
    <div class="row font-weight-bold mb-2">
        <div class="col-2">Название </div>
        <div class="col-2">Поведение </div>
        <div class="col-1">Приоритет </div>
        <div class="col-2">Продолжительность </div>
        <div class="col-2 p-0">Отображать в табеле</div>
        <div class="col-2">Тип платежа</div>
        <div class="col-1"></div>
    </div>


    @foreach($rentEvents as $rentEvent)
        <div class="row row-table">
            <div class="col-2" style="background-color:{{$rentEvent->color}}">{{$rentEvent->name}}</div>
            <div class="col-2">{{$rentEvent->action}}</div>
            <div class="col-1">{{$rentEvent->priority}}</div>
            <div class="col-2">{{$rentEvent->duration}}</div>
            <div class="col-1"></div>
            <div class="col-1">
                <input type="checkbox" onclick="return false;"  @if($rentEvent->visibleTimeSheet)checked @endif/>
            </div>
            <div class="col-2">{{$rentEvent->operationType->name}} </div>
            <div class="col-1"><a class="btn btn-ssm btn-outline-warning DialogUserMin" href="/rentEvent/edit?eventId={{$rentEvent->id}}" title="Редактировать"> <i class="far fa-edit"></i></a></div>
        </div>
    @endforeach
@endsection




@section('js')


@endsection
