@extends('../adminIndex')

@php

@endphp
@section('header')
            <h6 class="m-0 mr-3">К оплате</h6>
@endsection


@section('content')

    @forelse($toPayments as $toPayment)
        {{$toPayment->sum}}<br/>
    @empty
    @endforelse

@endsection


@section('js')

@endsection


