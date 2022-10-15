@extends('../adminIndex')

@php

@endphp
@section('header')

@endsection

@section('content')

<div class="row">
    <div class="col-2"><a href="/contract/contractFullInfo/{{$paymentObj->contract->id}}" class="btn btn-ssm btn-secondary">К договору</a></div>
</div>
    <div class="row">
        <div class="col-1" title="Дата"><strong>Дата :</strong></div>
        <div class="col-3">{{$paymentObj->dateTime->format('d-m-Y h:i')}} </div>
        <div class="col-2" title="Тип платежа"><strong>Тип платежа :</strong></div>
        <div class="col-2">{{$paymentObj->operationType->name}}</div>
        <div class="col-2" title="Сумма"><strong>Сумма/Остаток :</strong></div>
        <div class="col-2">{{$paymentObj->payment}}/{{$paymentObj->balance}}</div>
    </div>
    <div class="row">
        <div class="col-2" title="Имя"><strong>Имя :</strong></div>
        <div class="col-2">{{$paymentObj->name}} </div>
        <div class="col-1" title="Счет"><strong>Счет :</strong></div>
        <div class="col-3">{{$paymentObj->account->name}}</div>
        <div class="col-2" title="Субьект"><strong>Субьект :</strong></div>
        <div class="col-2">{{$paymentObj->subject->nickname}}</div>
    </div>
    <div class="row mb-3">
        <div class="col-2" title="Машина"><strong>Машина :</strong></div>
        <div class="col-2">{{$paymentObj->car->nickName}}</div>
        <div class="col-2" title="Договор"><strong>Договор :</strong></div>
        <div class="col-2">
            @if ($paymentObj->contract->id)
                {{$paymentObj->contract->number}}
                <i class="fas fa-info-circle text-primary" title="{{$paymentObj->contract->subjectFrom->nickname}}&#013;{{$paymentObj->contract->subjectTo->nickname}}&#013;{{$paymentObj->contract->status->name}}&#013;{{$paymentObj->contract->type->name}}"></i>
            @endif
        </div>
        <div class="col-2" title="Группа"><strong>Группа :</strong></div>
        <div class="col-2">{{$paymentObj->carGroup->nickName}}</div>
    </div>


    <input hidden disabled class="form-control-plaintext" id="paymentSum" value="{{$paymentObj->payment-$paymentObj->balance}}"/>

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Услуга</div>
        <div class="col-2">Договор</div>
        <div class="col-2">Тип платежа</div>
        <div class="col-2">Стоимость</div>
        <div class="col-2">Распределить</div>
    </div>
    <form method="post" action="/payment/allocatePayment">
        @csrf
        <input name="paymentId" value="{{$paymentObj->id}}" hidden/>
        @foreach($toPaymentsObj as $toPayment)
            <div class="row row-table" data-id="{{$toPayment->id}}">
                <div class="col-2">{{$toPayment->dateTime->format('d-m-Y H:i')}}</div>
                <div class="col-2">{{$toPayment->name}}</div>
                <div class="col-2">{{$toPayment->contractNumber}}</div>
                <div class="col-2">{{$toPayment->operationName}}</div>
                <div class="col-2 @if ($toPayment->sum == $toPayment->paymentSum) fullAllocate @else {{$toPayment->paymentSum ? 'partAllocate':''}}  @endif">{{$toPayment->sum}}/{{$toPayment->paymentSum}}</div>
                <div class="col-2">
                    @if ($toPayment->sum != $toPayment->paymentSum)
                        <input class="allocate" type="checkbox" name="toPaymentId[]" value="{{$toPayment->id}}"/>
                        <input class="h-75 hiddenInput" hidden disabled name="toPaymentSum[]" data-paymentsum = "{{$toPayment->sum-$toPayment->paymentSum}}" value="0" size="5"/>
                    @endif
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
            $(':input[type ="submit"]').prop('disabled',true);
        });


        function calculateSumPayment() {
            $(':input[type ="submit"]').prop('disabled',false);
            paymentSum = parseInt($('#paymentSum').val());
            balance = 0;
            $('.hiddenInput').each(function () {
                balance += parseInt($(this).val());
            });
            $("#balance").val(balance);

            $('#balance').removeClass("notAllocate").removeClass("fullAllocate").removeClass("partAllocate")


            if (paymentSum == balance) {
                $('#balance').addClass("fullAllocate");
            } else {
                if ((Math.abs(balance) < Math.abs(paymentSum)) && (balance * paymentSum >= 0)) {
                    $('#balance').addClass("partAllocate");
                } else {
                    $('#balance').addClass("notAllocate");
                    $(':input[type ="submit"]').prop('disabled',true);
                }
            }
        }




        $(".allocate").click(function(){
            hiddenInput = $(this).next(".hiddenInput");
            paymentMaxSum = parseInt($('#paymentSum').val());

            if ($(this).is(':checked')) {
                hiddenInput.val(hiddenInput.data('paymentsum'));
                hiddenInput.show();
                hiddenInput.addClass("fullAllocate");
                hiddenInput.prop('disabled', false);
            } else {
                hiddenInput.val(0);
                hiddenInput.hide();
                hiddenInput.removeClass("fullAllocate").removeClass("partAllocate");
                hiddenInput.prop('disabled', true);
            };

            calculateSumPayment();
        });

        $(".hiddenInput").blur(function(){
            $(this).removeClass("notAllocate").removeClass("fullAllocate").removeClass("partAllocate")
            inputSum = parseInt($(this).val());
            paymentSum = parseInt($(this).data('paymentsum'));



            if (inputSum == paymentSum){
                $(this).addClass("fullAllocate");
            } else {
                if (Math.abs(inputSum) < Math.abs(paymentSum) && inputSum*paymentSum > 0){
                    $(this).addClass("partAllocate");
                } else {
                    inputSum = paymentSum;
                    $(this).addClass("fullAllocate");
                }
            }




            $(this).val(inputSum);

            calculateSumPayment();

        });





    </script>


@endsection


