@extends('../adminIndex')

@php

@endphp
@section('header')
Платеж:{{$paymentObj->id}} Сумма:{{$paymentObj->payment}} Остаток:{{$paymentObj->balance}}
@endsection



@section('content')
Не оплаченные услуги

@endsection


@section('js')

@endsection


