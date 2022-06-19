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
            <input readonly disabled class="form-control-plaintext" id="paymentSum" value="{{$paymentObj->balance}}"/>
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
                <div class="col-2">{{$toPayment->sum}}/{{$toPayment->paymentSum}}</div>
                <div class="col-2">
                    <input class="allocate" type="checkbox" @if($toPayment->paymentId) checked  @endif data-sum="{{$toPayment->sum}}" name="toPaymentId[]" value="{{$toPayment->id}}"/>
                    <input class="h-75 hiddenInput @if($toPayment->paymentId) fullAllocate noBorderInput" value="{{$toPayment->sum}}" data-sum="{{$toPayment->sum}}" @else" hidden disabled @endif data-maxsum="{{$toPayment->sum}}" name="toPaymentSum[]" size="5"/>
                </div>
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
        $(function() {
            $(".hiddenInput").each(function(){
                if ($(this).attr('hidden')){
                    $(this).hide();
                }
            })
            $(".hiddenInput").attr('hidden', false);
        });


        $(".allocate").click(function(){
            paymentSum = parseInt($('#paymentSum').val());
            hiddenInput = $(this).next(".hiddenInput");



                if ($(this).is(':checked')) {
                    currentSum = parseInt($(this).data('sum'));
                    if ($('#paymentSum').val()>0) {
                        if (currentSum > paymentSum){
                            currentSum = paymentSum;
                            hiddenInput.removeClass("fullAllocate").addClass("partAllocate");
                        } else {
                            hiddenInput.removeClass("partAllocate").addClass("fullAllocate");
                        }
                        $('#paymentSum').val(paymentSum - currentSum);
                        hiddenInput.show();
                        hiddenInput.val(currentSum);
                        hiddenInput.data('sum',currentSum);
                        hiddenInput.prop('disabled', false);
                    } else {
                        $(this).prop("checked", false);
                    }
                } else {
                    currentSum = hiddenInput.data('sum');
                    $('#paymentSum').val(paymentSum + currentSum);
                    hiddenInput.hide();
                    hiddenInput.prop('disabled', true);
                }
        });


        $(".hiddenInput").focusout(function(){
            maxSum = parseInt($(this).data('maxsum'));
            paymentSum = parseInt($('#paymentSum').val());
            currentSum = parseInt($(this).val());
            prevSum = parseInt($(this).data('sum'));

            if (currentSum > maxSum){
                currentSum = maxSum;
            }

            if (currentSum > paymentSum + prevSum){
                currentSum = paymentSum + prevSum;
            }

            if (currentSum == maxSum){
                $(this).removeClass("partAllocate").addClass("fullAllocate");
            } else {
                $(this).removeClass("fullAllocate").addClass("partAllocate");
            }

            deltaSum = prevSum - currentSum;
            $('#paymentSum').val(paymentSum + deltaSum);
            $(this).val(currentSum);
            $(this).data('sum',currentSum);

        });


    </script>


@endsection


