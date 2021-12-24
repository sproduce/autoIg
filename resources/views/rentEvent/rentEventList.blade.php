@extends('../adminIndex')

@php

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3 DialogUserMin" title="Добавить событие" href="/rentEvent/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0 mr-3">События</h6>
@endsection


@section('content')
    <div class="row font-weight-bold">
        <div class="col-3">Название </div>
        <div class="col-3">Поведение </div>
    </div>


    @foreach($rentEvents as $rentEvent)
        <div class="row row-table">
            <div class="col-3" style="background-color:{{$rentEvent->color}}">{{$rentEvent->name}}</div>
            <div class="col-3">{{$rentEvent->action}}</div>
            <div class="col-2"></div>
            <div class="col-2"></div>
        </div>
    @endforeach
@endsection




@section('js')

@endsection
