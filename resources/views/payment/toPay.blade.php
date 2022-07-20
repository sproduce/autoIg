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
            <div class="col-1 text-center">Сумма /<br/>Оплачено</div>
            <div class="col-1 text-center">Договор</div>
            <div class="col-2 text-center">От кого</div>
            <div class="col-2 text-center">Кому</div>
        </div>

        @foreach($toPayments as $toPayment)
            <div class="row row row-table">
                <div class="col-2">
                        {{$toPayment->timeSheetDateTime->format('d-m-Y H:i')}}<br/>
                        {{$toPayment->paymentPayUp->format('d-m-Y')}}
                </div>
                <div class="col-2">{{$toPayment->carNickName}}</div>
                <div class="col-2">
                    <a href="/rentEvent/{{$toPayment->eventId}}/{{$toPayment->timeSheetDataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробно о событии"><i class="fas fa-info-circle"></i></a>
                    {{$toPayment->eventName}}
                    <br/>
                    {{$toPayment->operationTypeName}}
                </div>
                <div class="col-1 text-right
                  @if ($toPayment->paymentSum == 0)
                                notAllocate
                        @else
                            @if ($toPayment->paymentSum == $toPayment->toPaymentSum)
                                fullAllocate
                            @else
                                partAllocate
                            @endif
                        @endif
                ">{{$toPayment->toPaymentSum}}<br/>{{$toPayment->paymentSum}}</div>
                <div class="col-1 text-center">
                    @if ($toPayment->toPaymentContractId)
                        {{$toPayment->contractNumber}}
                    @else
{{--                        <a href="/payment/copyToPayClientDialog?toPayId={{$toPayment->toPaymentId}}" class="btn btn-ssm btn-outline-success DialogUserMin" title="Добавить к оплате">--}}
{{--                            <i class="fas fa-user-plus"></i>--}}
{{--                        </a>--}}
                    @endif
                </div>
                <div class="col-2">
                    {{$toPayment->subjectFromNickname}}
                </div>
                <div class="col-2">
                    {{$toPayment->subjectToNickname}}
                </div>
            </div>

        @endforeach
    @endif
@endsection


@section('js')

@endsection


