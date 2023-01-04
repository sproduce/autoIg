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


    <input hidden disabled class="form-control-plaintext" id="paymentSum" value="{{$paymentObj->payment-$paymentObj->balance}}"/>
    <input hidden disabled  id="paymentBalance" value="{{$paymentObj->balance}}"/>
@if(count($toPaymentsObj))
    <form method="post" action="/payment/allocatePayment">
        @csrf
        
        <div class="row mt-4">
            <div class="col-6"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
            <div class="col-3"><strong>Баланс : </strong><span class="balance"></span></div>
            <div class="col-3"><strong>Сумма / Распределено </strong><span>{{$paymentObj->payment}} / </span> <span class="paymentBalanceSum"></span> </div>
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
                    @endif
                </div>
            </div>
        @endforeach
        
        
        <div class="row mt-4">
            <div class="col-6"><input type="submit" class="btn btn-ssm btn-primary" value="Сохранить"/></div>
            <div class="col-3"><strong>Баланс : </strong><span class="balance"></span></div>
            <div class="col-3"><strong>Сумма / Распределено </strong><span>{{$paymentObj->payment}} / </span> <span class="paymentBalanceSum" id="paymentBalanceSum"></span> </div>
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
            $(".paymentBalanceSum").text(parseInt($("#paymentBalance").val()));
        });


        function calculateSumPayment() {
            
            paymentBalance = parseInt($("#paymentBalance").val());
            
            paymentSum = parseInt($('#paymentSum').val());
            balance = 0;
            $('.hiddenInput').each(function () {
                balance += parseInt($(this).val());
            });
            paymentNewBalance = paymentBalance + balance;
                if (balance){$(':input[type ="submit"]').prop('disabled',false);}
                    else {$(':input[type ="submit"]').prop('disabled',true);
                                    }
            $(".balance").text(balance);

            $(".paymentBalanceSum").text(paymentNewBalance);

            $('.balance').removeClass("notAllocate").removeClass("fullAllocate").removeClass("partAllocate")


            if (paymentSum == balance) {
                $('.balance').addClass("fullAllocate");
            } else {
                if ((Math.abs(balance) < Math.abs(paymentSum)) && (balance * paymentSum >= 0)) {
                    $('.balance').addClass("partAllocate");
                } else {
                    $('.balance').addClass("notAllocate");
                    $(':input[type ="submit"]').prop('disabled',true);
                }
            }
        }



        $(".allocateLine").dblclick(function(){
            $(this).find(".allocate").trigger('click');

        
        
        
        })



        $(".allocate").click(function(){
        
            paymentMaxSum = parseInt($('#paymentSum').val());    
             balance = 0;
            $('.hiddenInput').each(function () {
                balance += parseInt($(this).val());
            });
                hiddenInput = $(this).next(".hiddenInput");
                paymentBalance = parseInt($("#paymentBalance").val());

            if ($(this).is(':checked')) {
                
                paymentSum = parseInt(hiddenInput.data('paymentsum'));  
                console.log(paymentMaxSum);
                if(Math.abs(paymentSum) > Math.abs(paymentMaxSum) && paymentSum*paymentMaxSum > 0){
                    paymentSum = paymentMaxSum;
                        }
                
                hiddenInput.val(paymentSum);
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
            paymentMaxSum = parseInt($('#paymentSum').val());


            if(Math.abs(paymentSum) > Math.abs(paymentMaxSum) && paymentSum*paymentMaxSum > 0){
                paymentSum = paymentMaxSum;
                        }
                        


            if (inputSum == paymentSum){
                $(this).addClass("fullAllocate");
            } else {
                if (Math.abs(inputSum) < Math.abs(paymentSum) && inputSum*paymentSum > 0){
                    $(this).addClass("partAllocate");
                } else {
                    console.log(paymentSum);
                    inputSum = paymentSum;
                    $(this).addClass("fullAllocate");
                }
            }




            $(this).val(inputSum);

            calculateSumPayment();

        });





    </script>


@endsection


