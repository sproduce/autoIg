@extends('../adminIndex')

@php

    $payments=$paymentsObj->get('payments');
    $filters=$paymentsObj->get('filters');
    $types=$paymentsObj->get('types');
    $accounts=$paymentsObj->get('accounts');

@endphp
@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить платеж" href="/payment/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0">Платежи </h6>
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


        <div class="row align-items-center font-weight-bold border mt-3 pb-1 mb-3">
            <div class="col-2">
                <div class="row">
                    <div class="col-7">
                        Дата/Время
                    </div>
                    <div class="5">
                        Сумма <br/>(Комиссия)
                    </div>
                </div>

            </div>
            <div class="col-2">Счет<br/>
                <select name="accountId"  id="accountId">
                    <option value="0">Все</option>
                    @foreach( $accounts as $account)
                        <option value="{{$account->id}}"  @if($filters['accountId']==$account->id) selected @endif>{{$account->nickName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">Тип операции<br/>
                <select name="typeId"  id="typeId">
                    <option value="0">Все</option>
                    @foreach( $types as $type)
                        <option value="{{$type->id}}" @if($filters['typeId']==$type->id) selected @endif>{{$type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">Кто</div>
            <div class="col-2">Группа</div>
            <div class="col-1">Комментарий</div>
        </div>
    </form>

    @if($payments->count())
        <div class="row">
            <div class="col-2 text-right pr-0 font-weight-bold">
                {{$payments->sum('payment')}}
            </div>
        </div>

        @foreach($payments as $payment)
            <div class="row row-table">

                <div class="col-2">
                    <div class="row">
                        <div class="col-2 p-0">{{$loop->iteration}}.</div>
                        <div class="col-6 p-0" title="{{$payment->dateTime}}">
                            {{$payment->dateTime->format('d-m-Y')}}
                        </div>
                        <div class="col-4 text-right p-0">
                            @if($payment->comm) ({{$payment->comm}}) @endif {{$payment->payment}}
                        </div>
                    </div>
                </div>
                <div class="col-2">{{$payment->account->nickName}}</div>
                <div class="col-2">{{$payment->operationType->name}}</div>
                <div class="col-2">{{$payment->name}}
                    @if($payment->carOwnerId)
                        {{$payment->carOwner->nickName}}
                        <a href="/carOwner/info?carOwnerId={{$payment->carOwnerId}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                    @endif
                    @if($payment->carDriverId)
                        {{$payment->carDriver->nickname}}
                        <a href="/dialog/carDriverInfo?carDriverId={{$payment->carDriver->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                    @endif
                </div>

                <div class="col-2">
                    @if ($payment->carId)
                        {{$payment->car->nickName}}
                        <a href="/dialog/carInfo?carId={{$payment->car->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                    @endif
                    @if ($payment->contractId)
                        {{$payment->contract->number}}
                            <a href="/contract/info?contractId={{$payment->contract->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                    @endif
                    @if ($payment->carGroupId)
                        {{$payment->carGroup->name}}
                            <a href="/carGroup/info?carGroupId={{$payment->carGroup->id}}" class="btn btn-ssm btn-outline-info DialogUserMin"> <i class="fas fa-info-circle"></i></a>
                    @endif
                </div>
                <div class="col-1">
                    {{$payment->comment}}
                </div>
                <div class="col-1">
                    <a class="btn btn-ssm btn-outline-warning" href="/payment/edit?paymentId={{$payment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <a href="/payment/delete?paymentId={{$payment->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить платеж?')"><i class="fas fa-trash"></i> </a>
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
