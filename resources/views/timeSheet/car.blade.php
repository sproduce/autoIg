@extends('../adminIndex')

@php

@endphp
@section('header')
            <h6 class="m-0 mr-3">События машины {{$carObj->nickName}}</h6>
@endsection


@section('content')
    <form type="GET" action="">
        <div class="form-row text-center">
            <div class="form-group col-md-2 input-group-sm">
                <input class="form-control" type="date" name="fromDate"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input class="form-control" type="date" name="toDate"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input type="submit" class="btn btn-sm btn-primary" value="Показать"/>
            </div>
        </div>

    </form>



@endsection


@section('js')

@endsection
