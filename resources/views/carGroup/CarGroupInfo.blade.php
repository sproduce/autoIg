@extends('../adminIndex')

@php

    $carGroupInfo=$carGroupInfoObj->get('carGroupInfo');
    $carGroup=$carGroupInfoObj->get('carGroup');


@endphp
@section('header')
    <button class="btn btn-ssm btn-outline-success mr-3" onclick="addCar();" title="Добавить машину"><i class="far fa-plus-square"></i></button>
    <h6 class="m-0">Машины в группе</h6>
@endsection

@section('content')


    <div class="row align-items-center font-weight-bold border">
        <div class="col-3">
            Машина
        </div>
        <div class="col-2">
            NickName
        </div>
        <div class="col-2">
            Добавлена
        </div>
        <div class="col-2">
            Удалена
        </div>

        <div class="col-2">

        </div>
    </div>
    @if($carGroupInfo->count())
        @foreach($carGroupInfo as $groupInfo)
            <div class="row row-table">
                <div class="col-3">
                     {{$groupInfo->car->generation->name}}
                </div>
                <div class="col-2">
                    {{$groupInfo->car->nickName}}
                </div>
                <div class="col-2">
                    {{$groupInfo->start}}
                </div>
                <div class="col-2">
                    {{$groupInfo->finish}}
                </div>
                <div class="col-2">

                </div>
            </div>

        @endforeach
    @else
        <div class="row mt-3">
            <div class="col-12 text-center">
                <h5>Машины в группу не добавлены</h5>
            </div>
        </div>
    @endif
<div id="inputCar" class="displayNone mt-4">
<form action="/carGroup/addCar" method="POST">
    @csrf
    <input name="groupId" id="groupId" value="{{$carGroup->id}}" hidden/>
    <div class="form-row">

            <div class="col-3 input-group-sm">
                <input id="carId" name="carId" hidden required/>
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <div class="input-group-text p-0">
                            <a href="/contract/addCar" class="btn btn-ssm btn-outline-success DialogUser"><i class="fas fa-search-plus"></i></a>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="carText" name="carText" disabled/>
                </div>


            </div>
            <div class="col-2 input-group-sm">

            </div>
            <div class="col-2 input-group-sm">
                <input type="date" name="start" class="form-control" required/>
            </div>
            <div class="col-2 input-group-sm">
                <input type="date" name="finish" class="form-control"/>
            </div>
        <div class="col-2 input-group-sm">
            <button class="btn btn-ssm btn-outline-primary">Добавить</button>
        </div>
    </div>
</form>
</div>
    <div class="row">
        <div class="col-4">

        </div>
    </div>




@endsection

@section ('js')
<script>
    function addCar(){
        $('#inputCar').toggle();
    }

</script>


@endsection



