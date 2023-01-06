@extends('../adminIndex')

@php

@endphp
@section('header')

@endsection

@section('content')

<div class="row">
    <div class="col-2">
        @if($paymentObj->contract->id)
            <a href="/contract/contractFullInfo/{{$paymentObj->contract->id}}" class="btn btn-ssm btn-secondary">К договору</a>
        @endif
    </div>
</div>
    <div class="row">
        <div class="col-1" title="Дата"><strong>Дата :</strong></div>
        <div class="col-3">{{$paymentObj->dateTime->format('d-m-Y h:i')}} </div>
        <div class="col-2" title="Тип платежа"><strong>Тип платежа :</strong></div>
        <div class="col-2">{{$paymentObj->operationType->name}}</div>
        <div class="col-2" title="Сумма"><strong>Сумма / Рапределено :</strong></div>
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


    <input hidden disabled  id="paymentBalance" value="{{$paymentObj->balance}}"/>
    <input hidden disabled  id="paymentSum" value="{{$paymentObj->payment}}"/>
    
@if(count($toPaymentsObj))
    <form method="post" action="/payment/allocatePayment">
        @csrf
        
        <div class="row mt-4">
            <div class="col-6"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
            <div class="col-4"><strong>Сумма / Распределено </strong><span>{{$paymentObj->payment}} / </span> <span class="paymentBalanceSum"></span> </div>
        </div>
    <div class="row align-items-center font-weight-bold border mt-4">
        <div class="col-11">
            <div class="row">
                <div class="col-1">Дата</div>
                <div class="col-2">Машина</div>
                <div class="col-1">Договор</div>
                <div class="col-1">Событие</div>
                <div class="col-1">Стоимость</div>
                <div class="col-2">Комментарий</div>
            </div>
        </div>
        
    </div>
    
        <input name="paymentId" value="{{$paymentObj->id}}" hidden/>
        
        @foreach($toPaymentsObj as $toPayment)
            <div class="row row-table allocateLine" data-id="{{$toPayment->id}}">
                <div class="col-11 pl-0">
                    @php
                        $event = $toPayment;
                    @endphp
                    @include('rentEvent.'.$toPayment->eventObj->action.'.line')
                </div>
                <div class="col-1">
                    @if ($toPayment->sum != $toPayment->paymentSum)
                        <input class="allocate" type="checkbox" name="toPaymentId[]" value="{{$toPayment->id}}"/>
                        <input class="h-75 hiddenInput" hidden disabled name="toPaymentSum[]" data-paymentsum = "{{$toPayment->sum-$toPayment->paymentSum}}" value="0" size="5"/>
                    @else
                        <input class="allocate" type="checkbox" name="toPaymentId[]" value="{{$toPayment->id}}" checked/>
                        <input class="h-75 hiddenInput" name="toPaymentSum[]" data-paymentsum = "{{$toPayment->sum}}" value="{{$toPayment->sum}}" size="5"/>
                    @endif
                </div>
            </div>
        @endforeach
        
        
        <div class="row mt-4">
            <div class="col-6"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
            <div class="col-4"><strong>Сумма / Распределено </strong><span>{{$paymentObj->payment}} / </span> <span class="paymentBalanceSum"></span> </div>
        </div>
    </form>
@endif
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
            calculateSumPayment();
        });


        function calculateSumPayment() {
            
            paymentSum = parseInt($('#paymentSum').val());
            balance = 0;
            $('.hiddenInput').each(function () {
                balance += parseInt($(this).val());
            });
                
            $("#paymentBalance").val(balance);
            $(".paymentBalanceSum").text(balance);

            $(':input[type ="submit"]').prop('disabled',false);
            $('.paymentBalanceSum').removeClass("fullAllocate").removeClass("partAllocate").removeClass("notAllocate");
            
            if (paymentSum == balance) {
                $('.paymentBalanceSum').addClass("fullAllocate");
            } else {
                if ((Math.abs(balance) < Math.abs(paymentSum)) && (balance * paymentSum >= 0)) {
                    $('.paymentBalanceSum').addClass("partAllocate");
                } else {
                    $('.paymentBalanceSum').addClass("notAllocate");
                    $(':input[type ="submit"]').prop('disabled',true);
                }
            }
        }



        $(".allocateLine").dblclick(function(){
            $(this).find(".allocate").trigger('click');

        
        
        
        })

        $(".allocate").click(function(){
            paymentMaxSum = parseInt($('#paymentSum').val())-parseInt($('#paymentBalance').val());    

            hiddenInput = $(this).next(".hiddenInput");
            hiddenInput.removeClass("fullAllocate").removeClass("partAllocate");
            currentPaymentSum = parseInt(hiddenInput.data('paymentsum'));  
            
            if ($(this).is(':checked')) {
                if(Math.abs(currentPaymentSum) > Math.abs(paymentMaxSum) && currentPaymentSum*paymentMaxSum > 0){
                    hiddenInput.val(paymentMaxSum);
                    hiddenInput.addClass("partAllocate");
                } else {hiddenInput.val(currentPaymentSum);
                    hiddenInput.addClass("fullAllocate");
                }
                hiddenInput.show();
                hiddenInput.prop('disabled', false);
            } else {
                hiddenInput.val(0);
                hiddenInput.hide();
                hiddenInput.prop('disabled', true);
            };
            




            calculateSumPayment();
                   
        });





        $(".hiddenInput").blur(function(){
        
            $(this).removeClass("notAllocate").removeClass("fullAllocate").removeClass("partAllocate")
            inputSum = parseInt($(this).val());
            paymentSum = parseInt($(this).data('paymentsum'));

            if(Math.abs(paymentSum) < Math.abs(inputSum) && paymentSum*inputSum > 0){
                inputSum = paymentSum;
            }

            if (inputSum == paymentSum){
                $(this).addClass("fullAllocate");
            } else {
                    $(this).addClass("partAllocate");
                } 

            $(this).val(inputSum);
            
            calculateSumPayment();

        });


    </script>


@endsection


