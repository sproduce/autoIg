@extends('../adminIndex')

@php
    $toPaymentObj = $toPaymentFullInfoObj->get('toPaymentObj');
    $toPaymentChildsObj = $toPaymentFullInfoObj->get('toPaymentChildsObj');


@endphp
@section('header')
<div class="h5">К оплате</div>
@endsection

@section('content')
    Платежи по услуге {{$toPaymentObj->id}} Сумма {{$toPaymentObj->sum}} Субьект {{$toPaymentObj->subjectFrom->nickname}}->{{$toPaymentObj->subjectTo->nickname}}
    <div class="row align-items-center font-weight-bold border mt-3">
        <div class="col-2">Сумма</div>
        <div class="col-4">Счет</div>
        <div class="col-4">Субьект</div>
    </div>

    @foreach($toPaymentChildsObj as $toPaymentChild)
        <div class="row row-table">
            <div class="col-2 text-right">{{$toPaymentChild->sum}} p.</div>
            <div class="col-4">{{$toPaymentChild->payment->account->nickName}}</div>
            <div class="col-4">{{$toPaymentChild->payment->subject->nickname}}</div>
        </div>
    @endforeach
    <div class="row row-table border-top mt-2">
        <div class="col-2 text-right">{{$toPaymentChildsObj->sum('sum')}} p.</div>
    </div>

@endsection


@section('js')

@endsection


