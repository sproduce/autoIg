@extends('../adminIndex')

@php

    $payments = $paymentsObj->get('payments');
    $filterValue = $paymentsObj->get('filterValue');
    $filterPossible = $paymentsObj->get('filterPossible');

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить платеж" href="/payment/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0 mr-3">Платежи </h6> {{$payments->sum('payment')}} ({{$payments->sum('comm')??'0'}})


@endsection

@section('content')
    <form method="GET" action="" id="filterForm">
        <div class="row">
            <div class="col-2">
                От: <input type="date" name="fromDate" value="{{$filterValue['fromDate']->toDateString()}}"/>
            </div>
            <div class="col-2">
                До: <input type="date" name="toDate" value="{{$filterValue['toDate']->toDateString()}}"/>
            </div>
            <div class="col-2">
                <button class="btn btn-ssm btn-success" type="submit">Показать</button>
            </div>
        </div>


        <div class="row align-items-center font-weight-bold border mt-3 pb-1">
            <div class="col-1">Дата</div>
            <div class="col-1">Сумма <br/>Распред.</div>
            <div class="col-3">
                <select name="accountId"  id="accountId" class="selectFilter">
                    <option value="0">Счет(Все)</option>
                    @foreach($filterPossible['accounts'] as $account)
                        <option value="{{$account->id}}"@if($filterValue['accountId'] == $account->id)selected @endif>{{$account->nickName}}</option>
                    @endforeach
                </select><br/>
                <select name="operationTypeId"  id="operationTypeId" class="selectFilter">
                    <option value="0">Тип операции (Все)</option>
                    @foreach($filterPossible['operationTypes'] as $type)
                        <option value="{{$type->id}}"@if($filterValue['operationTypeId'] == $type->id)selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-3">
                <select name="subjectId"  id="subjectId" class="selectFilter">
                    <option value="0">Субьект (Все)</option>
                    @foreach($filterPossible['subjects'] as $subject)
                        <option value="{{$subject->id}}"@if($filterValue['subjectId'] == $subject->id)selected @endif>{{$subject->nickname}}</option>
                    @endforeach
                </select><br/>
                Договор
            </div>
            <div class="col-2">
                <select name="carId" class="selectFilter">
                    <option value="0">Машина (Все)</option>
                    @foreach($filterPossible['motorPools'] as $car)
                        <option value="{{$car->id}}"@if($filterValue['carId'] == $car->id)selected @endif>{{$car->nickName}}</option>
                    @endforeach
                </select><br/>
                <select name="carGroupId" class="selectFilter">
                    <option value="0">Группа (Все)</option>
                    @foreach($filterPossible['carGroups'] as $carGroup)
                        <option value="{{$carGroup->id}}"@if($filterValue['carGroupId'] == $carGroup->id)selected @endif>{{$carGroup->nickName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-1">Комментарий</div>
            <div class="col-1"></div>
        </div>
    </form>
    @if($payments->count())
        @foreach($payments as $payment)
            <div class="row row-table">
                <div class="col-12">
                    <div class="row">
                        <div class="col-1
                            @if ($payment->balance == 0 && $payment->payment)
                                notAllocate
                            @else
                                @if ($payment->payment == $payment->balance)
                                    fullAllocate
                                @else
                                    partAllocate
                                @endif
                             @endif">
                            <a class="btn-ssm btn-outline-info" href="/payment/info/{{$payment->id}}"><i class="fas fa-info-circle"></i></a>
                            {{$loop->iteration}}.
                        </div>
                        <div class="col-1 text-right">
                            @if($payment->comm)
                                <i class="fas fa-comment-dollar" title="Комиссия {{$payment->comm}}"></i>
                            @endif
                            {{$payment->payment}}
                        </div>
                        <div class="col-3">{{$payment->account->nickName}}</div>
                        <div class="col-3">{{$payment->subject->nickname}}</div>
                        <div class="col-2">{{$payment->car->nickName}}</div>
                        <div class="col-1">
                            @if($payment->comment)
                                <i class="far fa-comment-dots" title="{{$payment->comment}}"></i>
                            @endif
                        </div>
                        <div class="col-1">
                            <a class="btn btn-ssm btn-outline-warning @if($payment->balance == $payment->payment && $payment->payment)disable-link @endif" href="/payment/edit/{{$payment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            <a href="/payment/delete?paymentId={{$payment->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить платеж?')"><i class="fas fa-trash"></i> </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1 p-0" title="{{$payment->dateTime}}">
                            {{$payment->dateTime->format('d-m-Y')}}
                        </div>
                        <div class="col-1 text-right">{{$payment->balance}}</div>
                        <div class="col-3">{{$payment->operationType->name}}</div>
                        <div class="col-3">{{$payment->contract->number}}</div>
                        <div class="col-2">{{$payment->nickName}}</div>
                        <div class="col-1"></div>
                        <div class="col-1">
                            <a href="/payment/allocatePayment/{{$payment->id}}" class="btn btn-ssm btn-outline-info"> <i class="fas fa-expand-arrows-alt" title="Распределить"></i></a>
                            <a href="/payment/allocatePaymentErase/{{$payment->id}}" class="btn btn-ssm btn-outline-danger"> <i class="fas fa-eraser" title="Отменить распределение"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    @else
        <div class="row mt-3">
            <div class="col-12 text-center">
                <h5>По таким параметрам платежи не найдены</h5>
            </div>
        </div>
    @endif

@endsection


@section('js')

    <script>
        $(".selectFilter").change(function(){
            $('#filterForm').submit();
        });
    </script>


@endsection
