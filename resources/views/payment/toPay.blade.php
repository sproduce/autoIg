@extends('../adminIndex')

@php
    $toPayments = $toPaymentsObj->get('toPayments');
    $filterValue = $toPaymentsObj->get('filterValue');
    $filterPossible = $toPaymentsObj->get('filterPossible');

@endphp
@section('header')

@endsection



@section('content')

    <form type="GET" action="" id="filterForm">
        <div class="d-flex flex-row">
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$filterValue['fromDate']->toDateString()}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$filterValue['toDate']->toDateString()}}"/>
            </div>
            <div class="p-2 input-group-sm">
                <input class="btn btn-sm btn-primary" value="Показать" type="submit"/>
            </div>
        </div>



        <div class="row align-items-center font-weight-bold border mt-3">
            <div class="col-1">Дата</div>
            <div class="col-1">Сумма<br/>Оплачено</div>
            <div class="col-2">
                <select name="carId" class="selectFilter">
                    <option value="0">Машина (Все)</option>
                    @foreach($filterPossible['motorPools'] as $car)
                        <option value="{{$car->id}}"@if($filterValue['carId'] == $car->id)selected @endif>{{$car->nickName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <select name="eventId" class="selectFilter">
                    <option value="0">События (Все)</option>
                    @foreach($filterPossible['events'] as $event)
                        <option value="{{$event->id}}"@if($filterValue['eventId'] == $event->id)selected @endif>{{$event->name}}</option>
                    @endforeach
                </select> <br/>
                <select name="operationTypeId" class="selectFilter">
                    <option value="0">Тип операции (Все)</option>
                    @foreach($filterPossible['operationTypes'] as $operationType)
                        <option value="{{$operationType->id}}"@if($filterValue['operationTypeId'] == $operationType->id)selected @endif>{{$operationType->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-3 text-center">Договор</div>
            <div class="col-3 text-center">
                <select name="subjectFromId" class="selectFilter">
                    <option value="0">От кого (Все)</option>
                    @foreach($filterPossible['subjects'] as $subject)
                        <option value="{{$subject->id}}"@if($filterValue['subjectFromId'] == $subject->id)selected @endif>{{$subject->nickname}}</option>
                    @endforeach
                </select>
                <br/>
                <select name="subjectToId" class="selectFilter">
                    <option value="0">Кому (Все)</option>
                    @foreach($filterPossible['subjects'] as $subject)
                        <option value="{{$subject->id}}"@if($filterValue['subjectToId'] == $subject->id)selected @endif>{{$subject->nickname}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    @if(isset($toPayments))
        @foreach($toPayments as $toPayment)
            <div class="row row row-table" data-id="{{$toPayment->toPaymentId}}">
                <div class="col-12">
                    <div class="row">
                        <div class="col-1 p-0" title="{{$toPayment->timeSheetDateTime->format('H:i')}}">
                            {{$toPayment->timeSheetDateTime->format('d-m-Y')}}
                        </div>
                        <div class="col-1 text-right">
                            {{$toPayment->toPaymentSum}}
                        </div>
                        <div class="col-2">
                            {{$toPayment->carNickName}}
                        </div>
                        <div class="col-2" style="background-color:{{$toPayment->eventColor}}">{{$toPayment->eventName}}</div>
                        <div class="col-3">{{$toPayment->contractNumber}}</div>
                        <div class="col-3">{{$toPayment->subjectFromNickname}}</div>
                    </div>
                    <div class="row">
                        <div class="col-1 p-0" title="">
                            {{$toPayment->paymentPayUp->format('d-m-Y')}}
                        </div>
                        <div class="col-1 text-right @if ($toPayment->paymentSum == 0)
                                    notAllocate
                                @else
                                    @if ($toPayment->paymentSum == $toPayment->toPaymentSum)
                                        fullAllocate
                                    @else
                                        partAllocate
                                    @endif
                                 @endif">
                            {{$toPayment->paymentSum}}
                        </div>
                        <div class="col-2">

                        </div>
                        <div class="col-2">
                            {{$toPayment->operationTypeName}}
                        </div>
                        <div class="col-3">

                        </div>
                        <div class="col-3"> {{$toPayment->subjectToNickname}}</div>
                    </div>
                </div>

            </div>
{{--                <div class="col-2">--}}
{{--                    <a href="/rentEvent/{{$toPayment->eventId}}/{{$toPayment->timeSheetDataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробно о событии"><i class="fas fa-info-circle"></i></a>--}}
{{--                    {{$toPayment->eventName}}--}}
{{--                    <br/>--}}
{{--                    {{$toPayment->operationTypeName}}--}}
{{--                </div>--}}
{{--                <div class="col-1 text-center">--}}
{{--                    @if ($toPayment->toPaymentContractId)--}}
{{--                        {{$toPayment->contractNumber}}--}}
{{--                    @else--}}

{{--                    @endif--}}
{{--                </div>--}}
{{--                <div class="col-2">--}}
{{--                    {{$toPayment->subjectFromNickname}}--}}
{{--                </div>--}}
{{--                <div class="col-2">--}}
{{--                    {{$toPayment->subjectToNickname}}--}}
{{--                </div>--}}
{{--            </div>--}}

        @endforeach
    @endif
@endsection


@section('js')
    <script>
        $(".selectFilter").change(function(){
            $('#filterForm').submit();
        });
    </script>
@endsection


