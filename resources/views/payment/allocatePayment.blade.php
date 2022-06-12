@extends('../adminIndex')

@php

@endphp
@section('header')

@endsection

@section('content')


    <div class="form-group row">

        <label class="col-sm-1 col-form-label" for="id" title="Платеж"><strong>Платеж :</strong></label>

        <div class="col-sm-2 pt-2">
            {{$paymentObj->id}}
        </div>
        <label class="col-sm-1 col-form-label" for="payment" title="Сумма"><strong>Сумма :</strong></label>
            <div class="col-sm-2 pt-2">
                {{$paymentObj->payment}}
            </div>
        <label class="col-sm-1 col-form-label" for="paymentSum" title="Остаток"><strong>Остаток :</strong></label>
        <div class="col-sm-2">
            <input readonly class="form-control-plaintext" id="paymentSum" value="{{$paymentObj->balance}}"/>
        </div>

    </div>


    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Услуга</div>
        <div class="col-2">Стоимость</div>
        <div class="col-2">Распределить</div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
    <form method="post" action="/payment/allocatePayment">
        @csrf
        <input name="paymentId" value="{{$paymentObj->id}}" hidden/>
        @foreach($toPaymentsObj as $toPayment)
            <div class="row row-table">
                <div class="col-2">{{$toPayment->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$toPayment->name}}</div>
                <div class="col-2">{{$toPayment->sum}}</div>
                <div class="col-2"><input class="allocate" type="checkbox" @if($toPayment->paymentId) checked  @endif data-sum="{{$toPayment->sum}}" name="toPaymentId[]" value="{{$toPayment->id}}"/></div>
            </div>
        @endforeach
        <div class="row mt-4">
            <div class="col-6"></div>
            <div class="col-2"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
        </div>

    </form>
@endsection


@section('js')
    <script>
        $(".allocate").click(function(){
            if ($('#paymentSum').val()>0) {
                if ($(this).is(':checked')) {
                    $('#paymentSum').val(parseInt($('#paymentSum').val()) - parseInt($(this).data('sum')));
                } else {
                    $('#paymentSum').val(parseInt($('#paymentSum').val()) + parseInt($(this).data('sum')));
                }
            }
        })
    </script>


@endsection


