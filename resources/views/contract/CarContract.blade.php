@extends('../adminIndex')

@php
    $contractTypes=$directoryObj->get('type');
    $contractStatuses=$directoryObj->get('status');
@endphp
@section('header')
    @if ($rentContractObj->id)
        <h6 class="m-0">Редактировать договор</h6>
    @else
        <h6 class="m-0">Добавить договор</h6>
    @endif
@endsection
@section('content')

    @if ($rentContractObj->id)
        <form method="POST" action="/contract/edit">
            <input type="number" name="id" id="id" value="{{$rentContractObj->id}}" hidden/>
    @else
        <form method="POST" action="/contract/add">
    @endif

    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" value="@if ($rentContractObj->id){{$rentContractObj->start->format('Y-m-d\TH:i:s')}}@else{{date('Y-m-d')}}T{{date('H:i')}}@endif" required/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" @if ($rentContractObj->finish) value="{{$rentContractObj->finish->format('Y-m-d\TH:i:s')}}" @endif class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" @if ($rentContractObj->finishFact) value="{{$rentContractObj->finishFact->format('Y-m-d\TH:i:s')}}" @endif class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($contractTypes as $contractType)
                            <option value="{{$contractType->id}}" @if ($rentContractObj->typeId == $contractType->id) selected @endif>{{$contractType->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="carGroupId" title="Группа машин">Группа машин</label>
                    <select name="carGroupId" id="carGroupId" class="form-control" required>
                        @foreach ($carGroupObjs as $carGroupObj)
                            <option value="{{$carGroupObj->id}}"  @if ($rentContractObj->carGroupId == $carGroupObj->id) selected @endif>{{$carGroupObj->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-5 input-group-sm">
                    <label for="driverId" title="Водитель">Водитель</label>
                    <a href="/contract/addDriver" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                        <input id="driverText" class="form-control" disabled/>
                        <input name="driverId" id="driverId"  hidden />
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>


                    <select name="statusId" id="statusId" class="form-control">
                        @foreach($contractStatuses as $contractStatus)
                            <option value="{{$contractStatus->id}}" @if ($rentContractObj->statusId == $contractStatus->id) selected @endif>{{$contractStatus->name}}</option>
                        @endforeach

                    </select>
                </div>


            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="price" title="Тариф договора">Тариф договора</label>
                    <input type="number" name="price" id="price" class="form-control" @if ($rentContractObj->price) value="{{$rentContractObj->price}}" @endif/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="balance" title="Баланс договора">Баланс договора</label>
                    <input type="number" name="balance" id="balance" class="form-control" @if ($rentContractObj->balance) value="{{$rentContractObj->balance}}" @endif/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="deposit" title="Депозит договора">Депозит договора</label>
                    <input type="number" name="deposit" id="deposit" class="form-control" @if ($rentContractObj->deposit) value="{{$rentContractObj->deposit}}" @endif/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" autocomplete="off" required @if ($rentContractObj->number) value="{{$rentContractObj->number}}" @endif/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="sum" title="Стоимость">Стоимость</label>
                    <input type="number" name="sum" id="sum" class="form-control" autocomplete="off" @if ($rentContractObj->sum) value="{{$rentContractObj->sum}}" @endif/>
                </div>

            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment" title="Комментарий">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control" @if ($rentContractObj->comment) value="{{$rentContractObj->comment}}" @endif/>
                </div>

            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            @if ($rentContractObj->id)
                <input type="submit" class="btn btn-primary" value="Сохранить">
            @else
                <input type="submit" class="btn btn-primary" value="Добавить">
            @endif

        </div>
    </div>
</form>



@endsection
