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
            <div class="col-2">
                Машина<br/>
                <select name="">
                    <option>Все ..</option>
                </select>
            </div>
            <div class="col-2">
                Событие<br/>
                <select name="">
                    <option>Все ..</option>
                </select>
            </div>
            <div class="col-1 text-center">Сумма</div>
            <div class="col-2 text-center">Платеж</div>
            <div class="col-1 text-center"></div>
            <div class="col-2 text-center">Комментарий</div>
        </div>

        @foreach($toPayments as $toPayment)
            <div class="row row row-table">
                <div class="col-2">{{$toPayment->timeSheetDateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$toPayment->carNickName}}</div>
                <div class="col-2">
                    @if ($toPayment->timeSheetDataId)
                        <a href="/{{$toPayment->eventAction}}/{{$toPayment->timeSheetDataId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробно о событии"><i class="fas fa-info-circle"></i></a>
                        {{$toPayment->eventName}}
                    @endif
                </div>
                <div class="col-1 text-right">{{$toPayment->toPaymentSum}}</div>
                <div class="col-2"></div>
                <div class="col-1 text-center">
                    @if ($toPayment->toPaymentSum<=0)
                        <a href="/payment/copyToPayClientDialog?toPayId={{$toPayment->toPaymentId}}" class="btn btn-ssm btn-outline-success DialogUserMin" title="Добавить к оплате">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    @endif
                </div>
                <div class="col-2">
                        {{$toPayment->toPaymentComment}}
                </div>
            </div>

        @endforeach
    @endif
@endsection


@section('js')

@endsection


