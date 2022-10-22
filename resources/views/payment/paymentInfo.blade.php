@extends('../adminIndex')

@php
    $paymentObj = $paymentFullInfoObj->get('paymentObj');
    $toPaymentsObj = $paymentFullInfoObj->get('toPaymentsObj');


@endphp
@section('header')
<div class="h5">Платеж</div>
@endsection

@section('content')
    <div class="row">
        <div class="col-1 p-0 text-right" title="Дата"><strong>Дата :</strong></div>
        <div class="col-1 pr-0" title="{{$paymentObj->dateTime->format('h:i')}}">{{$paymentObj->dateTime->format('d-m-Y')}}</div>
        <div class="col-2 text-right" title="Тип платежа"><strong>Тип платежа :</strong></div>
        <div class="col-4">{{$paymentObj->operationType->name}}</div>
        <div class="col-2 text-right" title="Сумма"><strong>Сумма/Распр-но :</strong></div>
        <div class="col-2">{{$paymentObj->payment}}/{{$paymentObj->balance}}</div>
    </div>
    <div class="row">
        <div class="col-1 p-0 text-right" title="Имя"><strong>Договор :</strong></div>
        <div class="col-1 pr-0" title="{{$paymentObj->contract->subjectFrom->nickname}}&#013;{{$paymentObj->contract->subjectTo->nickname}}&#013;{{$paymentObj->contract->status->name}}&#013;{{$paymentObj->contract->type->name}}">
                {{$paymentObj->contract->number}}
            </div>
        <div class="col-2 text-right" title="Счет"><strong>Счет :</strong></div>
        <div class="col-4">{{$paymentObj->account->name}}</div>
        <div class="col-2 text-right" title="Имя"><strong>Имя :</strong></div>
        <div class="col-2">{{$paymentObj->name}}</div>

    </div>
    <div class="row mb-3">
        <div class="col-1 p-0 text-right" title="Машина"><strong>Машина :</strong></div>
        <div class="col-1 pr-0">{{$paymentObj->car->nickName}}</div>
        <div class="col-2 text-right" title="Субьект"><strong>Субьект :</strong></div>
        <div class="col-4">{{$paymentObj->subject->nickname}}</div>
        <div class="col-2 text-right" title="Группа"><strong>Группа :</strong></div>
        <div class="col-2">{{$paymentObj->carGroup->nickName}}</div>
    </div>

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2 text-center">Событие</div>
        <div class="col-2 text-center">Сумма</div>
        <div class="col-2">Машина</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>

    @foreach($toPaymentsObj as $toPayment)
        <div class="row">
            <div class="col-2">{{$toPayment->timeSheet->event->name}}</div>
            <div class="col-2 text-right">{{$toPayment->paymentSum}} p.</div>
            <div class="col-2">{{$toPayment->timeSheet->car->nickName}}</div>
            <div class="col-2"></div>
            <div class="col-2"></div>
            <div class="col-2"></div>
        </div>

    @endforeach
@endsection


@section('js')

@endsection


