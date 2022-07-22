@extends('../adminIndex')

@php

    $payments=$paymentsObj->get('payments');
    $filters=$paymentsObj->get('filters');
    $types=$paymentsObj->get('types');
    $accounts=$paymentsObj->get('accounts');

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить платеж" href="/payment/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0 mr-3">Платежи </h6> {{$payments->sum('payment')}} ({{$payments->sum('comm')??'0'}})


@endsection

@section('content')
    <form method="GET" action="" id="filterForm">
    <div class="row">
        <div class="col-2">
            От: <input type="date" name="filterStart" value="{{$filters['filterStart']}}"/>
        </div>
        <div class="col-2">
            До: <input type="date" name="filterFinish" value="{{$filters['filterFinish']}}"/>
        </div>
        <div class="col-2">
            <button class="btn btn-ssm btn-success" type="submit">Показать</button>
        </div>
    </div>


        <div class="row align-items-center font-weight-bold border mt-3 pb-1">
            <div class="col-1">Дата</div>
            <div class="col-1">Сумма <br/>Распред.</div>
            <div class="col-3">
                <select name="accountId"  id="accountId">
                    <option value="0">Счет</option>
                    @foreach( $accounts as $account)
                        <option value="{{$account->id}}"  @if($filters['accountId']==$account->id) selected @endif>{{$account->nickName}}</option>
                    @endforeach
                </select><br/>
                <select name="typeId"  id="typeId">
                    <option value="0">Тип операции</option>
                    @foreach( $types as $type)
                        <option value="{{$type->id}}" @if($filters['typeId']==$type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>

            </div>
            <div class="col-3">
                <select name="subjectId"  id="subjectId">
                    <option value="0">Субьект</option>
                </select><br/>
                Договор
            </div>
            <div class="col-2">
                <select>
                    <option value="0">Машина</option>
                </select><br/>
                <select>
                    <option value="0">Группа</option>
                </select>
            </div>
            <div class="col-1"></div>
            <div class="col-1"></div>
        </div>
    </form>

    @if($payments->count())
        @foreach($payments as $payment)
            <div class="row row-table">
                <div class="col-12">
                    <div class="row">
                        <div class="col-1 @if ($payment->balance == 0)
                                    fullAllocate
                                @else
                                    @if ($payment->payment == $payment->balance)
                                        notAllocate
                                    @else
                                        partAllocate
                                    @endif
                                 @endif">
                                {{$loop->iteration}}.
                        </div>
                        <div class="col-1 text-right">{{$payment->payment}}</div>
                        <div class="col-3">{{$payment->account->nickName}}</div>
                        <div class="col-3">{{$payment->subject->nickname}}</div>
                        <div class="col-2">{{$payment->car->nickName}}</div>
                        <div class="col-1"></div>
                        <div class="col-1">
                            <a class="btn btn-ssm btn-outline-warning" href="/payment/edit/{{$payment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
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
                        <div class="col-2"></div>
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
        $("#typeId").change(function(){
            $('#filterForm').submit();
        });
    </script>
    <script>
        $("#accountId").change(function(){
            $('#filterForm').submit();
        });
    </script>



@endsection
