@extends('../adminIndex')


@section('header')
    <h6 class="modal-title w-100 font-weight-bold">Перевод между счетами</h6>

@endsection

@php
//    $accounts=$paymentGuide->get('accounts');

@endphp

@section('content')
    <form method="POST" action="/payment/storeBetweenAccounts">
        @if ($paymentObj->id)
            <input type="number" name="id" id="id" value="{{$paymentObj->id}}" hidden/>
        @endif
        @csrf



        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3">
                <input type="datetime-local" name="dateTime" value="{{old('dateTime',$paymentObj->dateTime ? $paymentObj->dateTime->format('Y-m-d\TH:i:s'):'')}}" id="dateTime" required/>
                <button class="btn btn-ssm btn-outline-success" title="Текущая дата" id="currentDate"><i class="fas fa-calendar-alt"></i></button>
            </div>
            <div class="col-1">Сумма</div>
            <div class="col-3"><input type="number" name="payment" value="{{old('payment',$paymentObj->payment)}}" required/></div>
            <div class="col-1">Комиссия</div>
            <div class="col-3"><input type="number" name="comm" value="{{old('comm',$paymentObj->comm)}}"/></div>
        </div>
        <div class="row align-items-center font-weight-bold border mt-3 pb-1">
            <div class="col-3">Откуда</div>
            <div class="col-3">Куда</div>
        </div>

        <div class="row">
            <div class="col-3">
                @foreach($paymentAccountsObj as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountIdFrom" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3">
                @foreach($paymentAccountsObj as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountIdTo" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
@endsection



@section('js')
    <script>
        $(".clickable").click(function(){
            $(this).children().prop("checked", true);
        });

        $("#currentDate").click(function(){
            currentDate = new Date();
            currentDate.setHours(currentDate.getHours()+ (currentDate.getTimezoneOffset()/-60));
            $("#dateTime").val(currentDate.toJSON().slice(0,16));
            return false;
        });


    </script>
@endsection
