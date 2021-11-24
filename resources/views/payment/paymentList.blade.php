@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить платеж" href="/payment/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0">Платежи </h6>
@endsection

@section('content')

    @if($payments->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-2">Дата/Время</div>
            <div class="col-1">Сумма</div>
            <div class="col-1">Комиссия</div>
            <div class="col-2">Счет</div>
            <div class="col-2">Тип операции</div>
            <div class="col-2">Информация</div>

        </div>


        @foreach($payments as $payment)
            <div class="row row-table">
                <div class="col-2"> {{$payment->dateTime}}</div>
                <div class="col-1 text-right">{{$payment->payment}}</div>
                <div class="col-1 text-right">{{$payment->comm}}</div>
                <div class="col-2">{{$payment->account->nickName}}</div>
                <div class="col-2">{{$payment->operationType->name}}</div>
                <div class="col-3">{{$payment->name}}</div>
                <div class="col-1">
                    <a class="btn btn-ssm btn-outline-warning" href="/payment/edit?paymentId={{$payment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <a href="/payment/delete?paymentId={{$payment->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить платеж?')"><i class="fas fa-trash"></i> </a>
                </div>
            </div>

        @endforeach
    @endif

@endsection


