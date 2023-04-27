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
            <div class="col-3">
                <strong>Машина </strong>{{$rentContractObj->car->nickName}}
                @if($rentContractObj->car->id)
                <a class="btn btn-ssm btn-outline-info ml-3 DialogUser" title="Информация" href="/motorPool/carInfoDialog/{{$rentContractObj->car->id}}"><i class="fas fa-info-circle"></i></a>
                @endif
            </div>
            <div class="col-3"><strong>Группа машин </strong>{{$rentContractObj->carGroup->nickName}}</div>
            <div class="col-3">
                <strong>От кого </strong>{{$rentContractObj->subjectFrom->nickname}}
                <a class="btn btn-ssm btn-outline-info ml-3 DialogUser" title="Информация" href="/subject/subjectInfo/{{$rentContractObj->subjectFrom->id}}"><i class="fas fa-info-circle"></i></a>
            </div>
            <div class="col-3">
                <strong>Клиент </strong>
                <a class="" href="/subject/fullInfo/{{$rentContractObj->subjectTo->id}}">
                    {{$rentContractObj->subjectTo->nickname}}
                </a>
                <a class="btn btn-ssm btn-outline-info ml-3 DialogUser" title="Информация" href="/subject/subjectInfo/{{$rentContractObj->subjectTo->id}}"><i class="fas fa-info-circle"></i></a>
                    
                
            </div>
        </div>
        <div class="row">
            <div class="col-3"><strong>Тариф договора </strong>{{$rentContractObj->price}}</div>
            <div class="col-3"><strong>Статус договора </strong>{{$rentContractObj->status->name}}</div>
            <div class="col-6"><strong>Комментарий </strong>{{$rentContractObj->comment}}</div>
        </div>
        <div class="row pt-2 mt-2 border-dark border-top">
            <div class="col-12">
            @forelse($rentContractObj->files as $file)
                <div class ="row row-table">
                    <div class="col-11">
                        <a href="/file/download/{{$file->file->id}}" title="Сохранить" class="btn btn-ssm btn-outline-success"><i class="fas fa-download"></i></a>
                        <a href="/file/show/{{$file->file->id}}" target="_blank">{{$file->file->fileName}}</a>
                    </div>
                    <div class="col-1">
                        <a href="/file/deleteFile/{{$rentContractObj->uuid}}/{{$file->id}}" class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить" onclick="return confirm('Удалить файл?')"><i class="fas fa-trash"></i> </a>
                    </div>
                </div>
            
            @empty
                Файлы не добавлены
            @endforelse
                </div>
        </div>
        <div class="row pt-2 mt-3 border-dark border-top">
            <a class="btn btn-ssm btn-outline-success DialogUserMin" href="/printDocument/select?contractId={{$rentContractObj->id}}" title="Документы"><i class="far fa-file-alt"></i></a>
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




            @foreach($contractPayments as $payment)
                <div class="row row-table" data-id="{{$payment->id}}">
                    <div class="col-2" title="{{$payment->dateTime->format('H:i')}}">
                        <a class="btn-ssm btn-outline-info" href="/payment/info/{{$payment->id}}"><i class="fas fa-info-circle"></i></a>
                        {{$payment->dateTime->format('d-m-Y')}}
                    </div>
                    <div class="col-1 p-0 text-right
                    @if ($payment->balance == 0)
                                    notAllocate
                                @else
                                    @if ($payment->payment == $payment->balance)
                                        fullAllocate
                                    @else
                                        partAllocate
                                    @endif
                                 @endif">{{$payment->payment}} p.</div>
                    <div class="col-2 text-right">{{$payment->remaind}} p.</div>
                    <div class="col-2">{{$payment->account->nickName}}</div>
                    <div class="col-3">{{$payment->operationType->name}}</div>
                    <div class="col-1"><a href="/payment/allocatePayment/{{$payment->id}}" class="btn btn-ssm btn-outline-info  @if ($payment->payment == $payment->balance)disable-link @endif"> <i class="fas fa-expand-arrows-alt" title="Распределить"></i></a></div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-2"><strong>Итого:</strong></div>
                <div class="col-1 p-0 text-right">{{$contractPayments->sum('payment')}} p.</div>
            </div>
        @endif

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


            @foreach($contractService as $event)
                @include('rentEvent.'.$event->eventObj->action.'.line')
            @endforeach
            <div class="row">
                <div class="col-5"><strong>Итого :</strong></div>
                <div class="col-1 p-0">{{$contractService->sum('toPaymentSum')}}p./{{$contractService->sum('toPaymentPaymentSum')}}p.</div>

            </div>
        @endif
    @endsection

    @section('js')

    @endsection
