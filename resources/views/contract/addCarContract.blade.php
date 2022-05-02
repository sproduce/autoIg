@extends('../adminIndex')

@php
    $contractTypes=$contractObj->get('type');
    $contractStatuses=$contractObj->get('status');
@endphp
@section('header')
    <h6 class="m-0">Добавить договор</h6>
@endsection
@section('content')
<form method="POST" action="/contract/add">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" value="{{date('Y-m-d')}}T{{date('H:i')}}"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($contractTypes as $contractType)
                            <option value="{{$contractType->id}}">{{$contractType->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="carGroupId" title="Группа машин">Группа машин</label>
                    <select name="carGroupId" id="carGroupId" class="form-control" required>
                        @foreach ($carGroupObjs as $carGroupObj)
                            <option value="{{$carGroupObj->id}}">{{$carGroupObj->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-5 input-group-sm">
                    <label for="driverId" title="Водитель">Водитель</label>
                    <a href="/contract/addDriver" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                    @if($driver->id)
                        <input id="driverText" class="form-control" value="{{$driver->surname}} {{$driver->name}} {{$driver->patronymic}}"  disabled/>
                        <input name="driverId" id="driverId" value="{{$driver->id}}"  hidden />
                        @else
                        <input id="driverText" class="form-control" disabled/>
                        <input name="driverId" id="driverId"  hidden />
                    @endif
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>


                    <select name="statusId" id="statusId" class="form-control">
                        @foreach($contractStatuses as $contractStatus)
                            <option value="{{$contractStatus->id}}">{{$contractStatus->name}}</option>
                        @endforeach

                    </select>
                </div>


            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="price" title="Тариф договора">Тариф договора</label>
                    <input type="number" name="price" id="price" class="form-control"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="balance" title="Баланс договора">Баланс договора</label>
                    <input type="number" name="balance" id="balance" class="form-control"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="deposit" title="Депозит договора">Депозит договора</label>
                    <input type="number" name="deposit" id="deposit" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" autocomplete="off" required/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="sum" title="Стоимость">Стоимость</label>
                    <input type="number" name="sum" id="sum" class="form-control" autocomplete="off"/>
                </div>

            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment" title="Комментарий">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control"/>
                </div>

            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="Добавить">
        </div>
    </div>
</form>



@endsection
