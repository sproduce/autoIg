    @extends('../adminIndex')


    @section('header')
                <h6 class="m-0 mr-3">Информация по договору № {{$rentContractObj->number}}</h6> <br/>
    @endsection

    @section('content')

        <div class="row">
            <div class="col-3"><strong>Начало договора </strong>{{$rentContractObj->start->format('d-m-Y H:i')}}</div>
            <div class="col-3"><strong>Окончание договора </strong>{{$rentContractObj->finish ? $rentContractObj->finish->format('d-m-Y H:i') : ''}}</div>
            <div class="col-3"><strong>Окончание договора по факту </strong>{{$rentContractObj->finishFact ? $rentContractObj->finishFact->format('d-m-Y H:i') : ''}}</div>
            <div class="col-3"><strong>Тип договора </strong>{{$rentContractObj->type->name}}</div>
        </div>
        <div class="row">
            <div class="col-3"><strong>Машина </strong>{{$rentContractObj->car->nickName}}</div>
            <div class="col-3"><strong>Группа машин </strong>{{$rentContractObj->carGroup->nickName}}</div>
            <div class="col-3"><strong>От кого </strong>{{$rentContractObj->subjectFrom->nickname}}</div>
            <div class="col-3"><strong>Клиент </strong>{{$rentContractObj->subjectTo->nickname}}</div>
        </div>
        <div class="row">
            <div class="col-3"><strong>Тариф договора </strong>{{$rentContractObj->price}}</div>
            <div class="col-3"><strong>Статус договора </strong>{{$rentContractObj->status->name}}</div>
            <div class="col-6"><strong>Комментарий </strong>{{$rentContractObj->comment}}</div>
        </div>




        <div class="row mt-4">
            <div class="col-12 text-center">
                <h5>
{{--                    <a class="btn btn-ssm btn-outline-success mr-3" href="/timesheet/add?carId={{$rentContractObj->carId}}&contractId={{$rentContractObj->id}}"><i class="fas fa-calendar-plus"></i></a>--}}
                    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить платеж" href="/payment/add?contractId={{$rentContractObj->id}}"><i class="far fa-plus-square"></i></a>
                    Платежи по договору {{$contractService->count() ? '':'не найдены'}}</h5>
            </div>
        </div>



        @if($contractPayments->count())
            <div class="row align-items-center font-weight-bold border">
                <div class="col-2">Дата/Время</div>
                <div class="col-1">Сумма</div>
                <div class="col-2">Не распределено</div>
                <div class="col-2">Счет</div>
                <div class="col-3">Тип платежа</div>
                <div class="col-1"></div>
            </div>
        @endif



            @foreach($contractPayments as $payment)
                <div class="row row-table" >
                    <div class="col-2" title="{{$payment->dateTime->format('H:i')}}">{{$payment->dateTime->format('d-m-Y')}}</div>
                    <div class="col-1 text-right p-0
                    @if ($payment->balance == 0)
                                    notAllocate
                                @else
                                    @if ($payment->payment == $payment->balance)
                                        fullAllocate
                                    @else
                                        partAllocate
                                    @endif
                                 @endif">{{$payment->payment}}</div>
                    <div class="col-2">{{$payment->balance}}</div>
                    <div class="col-2">{{$payment->account->nickName}}</div>
                    <div class="col-3">{{$payment->operationType->name}}</div>
                    <div class="col-1"><a href="/payment/allocatePayment/{{$payment->id}}" class="btn btn-ssm btn-outline-info  @if ($payment->payment == $payment->balance)disable-link @endif"> <i class="fas fa-expand-arrows-alt" title="Распределить"></i></a></div>
                </div>
            @endforeach


            <div class="row mt-4">
                <div class="col-12 text-center">
                    <h5>
                    <a class="btn btn-ssm btn-outline-success mr-3" href="/timesheet/add?carId={{$rentContractObj->carId}}&contractId={{$rentContractObj->id}}"><i class="fas fa-calendar-plus"></i></a>
                    <a class="btn btn-ssm btn-outline-success DialogUserMin mr-3" title="Добавить услугу" href="/contract/addAdditional/{{$rentContractObj->id}}"><i class="far fa-plus-square"></i></a>
                    Услуги по договору {{$contractService->count() ? '':'не найдены'}}</h5>
                </div>
            </div>
        @if($contractService->count())
            <div class="row align-items-center font-weight-bold border">
                <div class="col-1">Дата</div>
                <div class="col-2">Событие</div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-6 text-right p-0">Сумма</div>
                        <div class="col-6 text-right p-0">Оплачено</div>
                    </div>
                </div>
                <div class="col-3">Тип платежа</div>
                <div class="col-2">Комменатрий</div>
            </div>
        @endif

            @foreach($contractService as $service)
                <div class="row row-table">
                    <div class="col-1 p-0" title="{{$service->sheetsDateTime->format('H:i')}}">{{$service->sheetsDateTime->format('d-m-Y')}}</div>
                    <div class="col-2">{{$service->eventsName}}</div>
                    <div class="col-2 @if($service->paymentsSum>0)pl-3 @endif">
                        <div class="row">
                            <div class="col-6 p-0 text-right
                             @if ($service->paymentsPaymentSum == 0)
                                notAllocate
                             @else
                                @if ($service->paymentsSum == $service->paymentsPaymentSum)
                                    fullAllocate
                                @else
                                    partAllocate
                                @endif
                             @endif
                            ">{{$service->paymentsSum}}</div>
                            <div class="col-6 p-0 text-right">{{$service->paymentsPaymentSum}}</div>
                        </div>
                    </div>
                    <div class="col-3">{{$service->operationTypeName}}</div>
                    <div class="col-2">{{$service->paymentsComment}}</div>
                </div>
            @endforeach

    @endsection

    @section('js')

    @endsection
