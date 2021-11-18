@extends('../adminIndex')

@php
    $contractTypes=$directory->get('type');
    $contractStatuses=$directory->get('status');
    $contractTariffs=$directory->get('tariff');
@endphp
@section('header')
    <h6 class="m-0">Редактировать договор</h6>
@endsection
@section('content')
<form method="POST" action="/contract/edit">
    <input type="number" name="id" id="id" value="{{$contract->id}}" hidden/>
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($contract->start))}}"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" class="form-control" @if($contract->finish) value="{{ date('Y-m-d\TH:i', strtotime($contract->finish))}}"@endif/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" class="form-control"@if($contract->finishFact) value="{{ date('Y-m-d\TH:i', strtotime($contract->finishFact))}}@endif"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($contractTypes as $contractType)
                            <option value="{{$contractType->id}}" @if($contractType->id==$contract->typeId) selected  @endif>{{$contractType->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-5 input-group-sm">
                    <label for="driverId" title="Водитель">Водитель</label>
                    <a href="/contract/addDriver" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                    <input id="driverText" class="form-control" value="{{$contract->driver->surname}} {{$contract->driver->name}} {{$contract->driver->patronymic}}" disabled/>
                    <input name="driverId" id="driverId" value="{{$contract->driverId}}" hidden />
                </div>
                <div class="form-group col-md-5 input-group-sm">
                    <label for="carId" title="Машина">Машина</label>
                    <a href="/contract/addCar" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                        <input id="carText" class="form-control" value="{{$contract->car->generation->model->brand->name}} {{$contract->car->generation->model->name}} {{$contract->car->generation->name}} {{$contract->car->regNumber}}" disabled />
                        <input name="carId" id="carId" value="{{$contract->carId}}"  hidden />
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>
                    <select name="statusId" id="statusId" class="form-control">
                        @foreach($contractStatuses as $contractStatus)
                            <option value="{{$contractStatus->id}}" @if($contractStatus->id==$contract->statusId)selected @endif >{{$contractStatus->name}}</option>
                        @endforeach

                    </select>
                </div>


            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="tariffId" title="Тариф договора">Тариф договора</label>
                    <select name="tariffId" id="tariffId" class="form-control">
                        @foreach($contractTariffs as $contractTariff)
                            <option value="{{$contractTariff->id}}" @if($contractTariff->id==$contract->tariffId) selected @endif>{{$contractTariff->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="balance" title="Баланс договора">Баланс договора</label>
                    <input type=number name="balance" id="balance" class="form-control" value="{{$contract->balance}}"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="deposit" title="Депозит договора">Депозит договора</label>
                    <input type="number" name="deposit" id="deposit" class="form-control" value="{{$contract->deposit}}"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{$contract->number}}" autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment" title="Комментарий">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control" value="{{$contract->comment}}"/>
                </div>

            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="Сохранить">
        </div>
    </div>
</form>



@endsection
