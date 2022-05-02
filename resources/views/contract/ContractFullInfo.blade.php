    @extends('../adminIndex')


    @section('header')
                <h6 class="m-0 mr-3">Информация по договору </h6>
    @endsection

    @section('content')


        @if($contractPayments->count())
            <div class="row align-items-center font-weight-bold border mt-3 pb-1 mb-3">
                <div class="col-2">
                    <div class="row">
                        <div class="col-7">
                            Дата/Время
                        </div>
                        <div class="5">
                            Сумма <br/>(Комиссия)
                        </div>
                    </div>

                </div>
                <div class="col-2">Счет</div>
                <div class="col-2">Тип операции</div>
                <div class="col-2">Кто</div>
                <div class="col-2">Группа</div>
                <div class="col-1">Комментарий</div>
            </div>


            @foreach($contractPayments as $payment)
                <div class="row row-table">

                    <div class="col-2">
                        <div class="row">
                            <div class="col-2 p-0">{{$loop->iteration}}.</div>
                            <div class="col-6 p-0" title="{{$payment->dateTime}}">
                                {{$payment->dateTime->format('d-m-Y')}}
                            </div>
                            <div class="col-4 text-right p-0">
                                @if($payment->comm) ({{$payment->comm}}) @endif {{$payment->payment}}
                            </div>
                        </div>
                    </div>
                    <div class="col-2">{{$payment->account->nickName}}</div>
                    <div class="col-2">{{$payment->operationType->name}}</div>
                    <div class="col-2">{{$payment->name}}
                        @if($payment->carOwnerId)
                            {{$payment->carOwner->nickName}}
                            <a href="/carOwner/info?carOwnerId={{$payment->carOwnerId}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                        @endif
                        @if($payment->carDriverId)
                            {{$payment->carDriver->nickname}}
                            <a href="/dialog/carDriverInfo?carDriverId={{$payment->carDriver->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                        @endif
                    </div>

                    <div class="col-2">
                        @if ($payment->carId)
                            {{$payment->car->nickName}}
                            <a href="/dialog/carInfo?carId={{$payment->car->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                        @endif
                        @if ($payment->contractId)
                            {{$payment->contract->number}}
                                <a href="/contract/info?contractId={{$payment->contract->id}}" class="btn btn-ssm btn-outline-info DialogUser"> <i class="fas fa-info-circle"></i></a>
                        @endif
                        @if ($payment->carGroupId)
                            {{$payment->carGroup->name}}
                                <a href="/carGroup/info?carGroupId={{$payment->carGroup->id}}" class="btn btn-ssm btn-outline-info DialogUserMin"> <i class="fas fa-info-circle"></i></a>
                        @endif
                    </div>
                    <div class="col-1">
                        {{$payment->comment}}
                    </div>
                    <div class="col-1">
                        <a class="btn btn-ssm btn-outline-warning" href="/payment/edit?paymentId={{$payment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                        <a href="/payment/delete?paymentId={{$payment->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить платеж?')"><i class="fas fa-trash"></i> </a>
                    </div>
                </div>
            @endforeach

        @else
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <h5>Платежи не найдены</h5>
                </div>
            </div>
        @endif

        @if($contractService->count())
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <h5>Услуги по договору</h5>
                </div>
            </div>
            <div class="row align-items-center font-weight-bold border">
                <div class="col-2">Дата</div>
                <div class="col-3">Услуга</div>
                <div class="col-2">Сумма</div>
            </div>

            @foreach($contractService as $service)
                <div class="row row-table">
                    <div class="col-2"></div>
                    <div class="col-3"></div>
                    <div class="col-2">{{$service->sum}}</div>
                </div>
            @endforeach



        @else
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <h5>Услуги не найдены</h5>
                </div>
            </div>
        @endif



    @endsection










    @section('js')

    @endsection
