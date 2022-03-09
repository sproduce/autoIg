@extends('../adminIndex')

@php

@endphp
@section('header')
    <form type="GET" action="" id="filterForm">
        <div class="d-flex flex-row">
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <input class="btn btn-sm btn-primary" value="Показать" type="submit"/>
            </div>
        </div>
    </form>
@endsection


@section('content')

    @if(isset($toPayments))
        <div class="row align-items-center font-weight-bold border">
            <div class="col-2">Дата</div>
            <div class="col-2">Машина</div>
            <div class="col-2">Событие</div>
            <div class="col-1 text-center">Сумма</div>
            <div class="col-1 text-center">Оплачено</div>
            <div class="col-1 text-center">Платеж</div>
        </div>

        @foreach($toPayments as $toPayment)
            <div class="row row row-table">
                <div class="col-2">{{$toPayment->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$toPayment->nickName}}</div>
                <div class="col-2">
                    {{$toPayment->name}}
                    <a href="/{{$toPayment->action}}/{{$toPayment->dataId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробно о событии"><i class="fas fa-info-circle"></i></a>
                </div>
                <div class="col-1 text-right">{{$toPayment->sumToPay}}</div>
            </div>

        @endforeach
    @endif
@endsection


@section('js')

@endsection


