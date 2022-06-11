@extends('../adminIndex')

@php

@endphp
@section('header')
Платеж:{{$paymentObj->id}} Сумма:{{$paymentObj->payment}} Остаток: <input id="paymentSum" value="{{$paymentObj->balance}}"/>
@endsection

@section('content')
    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Услуга</div>
        <div class="col-2">Стоимость</div>
        <div class="col-2">Распределить</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
    <form>

        @foreach($toPaymentsObj as $toPayment)
            <div class="row row-table">
                <div class="col-2">{{$toPayment->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$toPayment->name}}</div>
                <div class="col-2">{{$toPayment->sum}}</div>
                <div class="col-2"><input class="allocate" type="checkbox" name="sum" value="{{$toPayment->sum}}"/></div>
            </div>
        @endforeach
        <input type="submit" value="Сохранить"/>
    </form>
@endsection


@section('js')
    <script>
        $(".allocate").click(function(){
            $('#paymentSum').val($('#paymentSum').val()-$(this).val());
          // console.log($(this).val());
        })
    </script>


@endsection


