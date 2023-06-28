@extends('../adminIndex')

@section('header')

@endsection



@section('content')

    <div class="row align-items-center font-weight-bold border">
        <div class="col-4">Счет</div>
        <div class="col-1">Баланс</div>
        <div class="col-1">Кол. плат</div>
    </div>


    @foreach($accountsObj as $account)
        <div class="row">
            <div class="col-4">{{$account->name}}</div>
            <div class="col-1 text-right sumToText">{{$account->paymentSum()}}</div>
            <div class="col-1 text-right">{{$account->payments->count()}}</div>            
        </div>
    @endforeach


@endsection


@section('js')

@endsection


