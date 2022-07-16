@extends('../adminIndex')

@php

@endphp
@section('header')

@endsection

@section('content')


    <div class="form-group row">

        <label class="col-sm-1 col-form-label pr-0" for="id" title="Платеж"><strong>Платеж :</strong></label>

        <div class="col-sm-2 pt-2">
            {{$paymentObj->id}}
        </div>
        <label class="col-sm-1 col-form-label pr-0" for="payment" title="Сумма"><strong>Сумма :</strong></label>
            <div class="col-sm-2 pt-2">
                {{$paymentObj->payment}}
            </div>
        <label class="col-sm-1 col-form-label pr-0" for="paymentSum" title="Остаток"><strong>Остаток :</strong></label>
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
                <div class="col-2 @if ($toPayment->sum == $toPayment->paymentSum) fullAllocate @else {{$toPayment->paymentSum ? 'partAllocate':''}}  @endif">{{$toPayment->sum}}/{{$toPayment->paymentSum}}</div>
                <div class="col-2">
                        <input class="allocate" type="checkbox" name="toPaymentId[]" value="{{$toPayment->id}}"/>
                        <input class="h-75 hiddenInput" hidden name="toPaymentSum[]" data-paymentsum = "{{$toPayment->sum}}" value="0" size="5"/>
                </div>
            </div>
        @endforeach
        <div class="row mt-4">
            <div class="col-6"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
            <div class="col-3"><strong>Баланс : </strong><input id="balance" class="h-75" size="5" readonly /></div>
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


        function calculateSumPayment(){
            paymentSum = parseInt($('#paymentSum').val());
            balance = 0;
            $('.hiddenInput').each(function() {
                balance +=  parseInt($(this).val());
            });
            $("#balance").val(balance);


            $('#balance').removeClass("notAllocate").removeClass("fullAllocate").removeClass("partAllocate")



            if (paymentSum == balance){
                $('#balance').addClass("fullAllocate");
            } else {
                if (paymentSum<0){
                    if (balance >= paymentSum && balance <= 0) {
                        $('#balance').addClass("partAllocate");
                    } else {
                        $('#balance').addClass("notAllocate");
                    }
                } else {
                    if (balance <= paymentSum && balance >= 0){
                        $('#balance').addClass("partAllocate");
                    } else {
                        $('#balance').addClass('notAllocate');
                    }
                }
            }
        }

        $(".allocate").click(function(){
            hiddenInput = $(this).next(".hiddenInput");

            if ($(this).is(':checked')) {
                hiddenInput.val(hiddenInput.data('paymentsum'));
                hiddenInput.show();
                hiddenInput.addClass("fullAllocate");
            } else {
                hiddenInput.val(0);
                hiddenInput.hide();
                hiddenInput.removeClass("fullAllocate").removeClass("partAllocate");
            };

            calculateSumPayment();
        });

        $(".hiddenInput").blur(function(){
            inputSum = parseInt($(this).val());
            paymentSum = parseInt($(this).data('paymentsum'));
            if (inputSum < 0){
                if (inputSum < paymentSum){
                    $(this).val(paymentSum);
                }
            }else {
                if (inputSum > paymentSum){
                    $(this).val(paymentSum);
                }
            }

            if (inputSum == paymentSum){
               $(this).removeClass("partAllocate").addClass("fullAllocate");
            } else {
                $(this).removeClass("fullAllocate").addClass("partAllocate");
            }

            calculateSumPayment();

        });





    </script>


@endsection


