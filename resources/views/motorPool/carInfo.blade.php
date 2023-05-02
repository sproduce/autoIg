@extends('../adminIndex')

@section('header')
<div class="row w-100">
    <div class="col-1">
        <a href="/motorPool/list" class="btn btn-ssm btn-outline-success" title="Список машин"><i class="fas fa-arrow-left"></i></a>
    </div>
    <div class="col-3"
        <h6 class="m-0">Информация о машине </h6>    
    </div>
</div>

@endsection

@section('content')

    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <strong>Марка</strong>
                </div>
                <div class="col-md-2">
                    {{$car->generation->model->brand->name}}
                </div>
                <div class="col-md-2">
                    <strong>Двигатель</strong>
                </div>
                <div class="col-md-2">
                    {{$car->engine->name}}
                </div>
                <div class="col-md-2">
                    <strong>Год выпуска</strong>
                </div>
                <div class="col-md-2">
                    {{$car->year}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <strong>Модель</strong>
                </div>
                <div class="col-md-2">
                    {{$car->generation->model->name}}
                </div>
                <div class="col-md-2">
                    <strong>Обьем</strong>
                </div>
                <div class="col-md-2">
                    {{$car->displacement}}
                </div>
                <div class="col-md-2">
                    <strong>Рег.номер</strong>
                </div>
                <div class="col-md-2">
                    {{$car->regNumber}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <strong>Поколение</strong>
                </div>
                <div class="col-md-2">
                    {{$car->generation->name}}
                </div>
                <div class="col-md-2">
                    <strong>Сил</strong>
                </div>
                <div class="col-md-2">
                    {{$car->hp}}
                </div>
                <div class="col-md-2">
                    <strong>Цвет</strong>
                </div>
                <div class="col-md-2">
                    {{$car->color}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <strong>Кузов</strong>
                </div>
                <div class="col-md-2">
                    {{$car->type->name}}
                </div>
                <div class="col-md-2">
                    <strong>Трансмиссия</strong>
                </div>
                <div class="col-md-2">
                    {{$car->transmission->name}}
                </div>
                <div class="col-md-2">
                    <strong>Nickname</strong>
                </div>
                <div class="col-md-2">
                   {{$car->nickName}}
                </div>
            </div>
                <div class="row border-top mt-2 pt-2">
                    <div class="col-md-2">
                        <strong>Вин код</strong>
                    </div>
                    <div class="col-md-4">
                        {{$car->vin}}
                    </div>
                    <div class="col-md-2">
                        <strong>Владелец</strong>
                    </div>
                    <div class="col-md-4">
                        {{$car->subjectOwner->nickname}}
                    </div>
                </div>
                @if ($car->subjectFrom)
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-md-2">
                            <strong>Сдается от</strong>
                        </div>
                        <div class="col-md-4">
                            {{$car->subjectFrom->nickname}}
                        </div>
                    </div>
                @endif
                <div class="row border-top mt-2 pt-2">
                    <div class="col-md-3">
                        <strong>Начало владения</strong>
                    </div>
                    <div class="col-md-3">
                        {{$car->dateStartText}}
                    </div>
                    <div class="col-md-3">
                        <strong>Снятие с учета</strong>
                    </div>
                    <div class="col-md-3">
                        {{$car->dateFinishText}}
                    </div>
                </div>

                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Участвует в группах </strong></div>
                </div>
                @foreach($car->groups as $carGroup)
                    <div class="row">
                        <div class="col-md-1"><strong>Группа</strong></div>
                        <div class="col-md-3">{{$carGroup->name}}</div>
                        <div class="col-md-2"><strong>Начало</strong></div>
                        <div class="col-md-2">{{$carGroup->pivot->startText}}</div>
                        <div class="col-md-2"><strong>Окончание</strong></div>
                        <div class="col-md-2">{{$carGroup->pivot->finishText}}</div>
                    </div>
                @endforeach

            <div class="row mt-2 pt-2">
                <div class="col-md-2">
                    <strong>Комментарий</strong>
                </div>
                <div class="col-md-10">
                    {{$car->comment}}
                </div>
            </div>

             @if(count($carPts))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>ПТС </strong> 
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить ПТС" href="/rentEvent/{{config('rentEvent.eventPts')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carPts as $pts)
                    <div class="row row-table">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-1">
                                    <a href="/rentEvent/{{$pts->eventId}}/{{$pts->dataId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                                    <strong>Дата</strong>
                                </div>
                                <div class="col-1">{{$pts->dateText}}</div>
                                <div class="col-1"><strong>Субьект</strong></div>
                                <div class="col-2">{{$pts->eventModel->subject->nickname}}</div>
                                <div class="col-1"><strong>Владелец</strong></div>
                                <div class="col-2">{{$pts->eventModel->subjectOwner->nickname}}</div>
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <a href="/file/fileInfoDialog/{{$pts->uuid}}" class="btn btn-ssm @if($pts->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Выдан</strong></div>
                                <div class="col-1">{{$pts->eventModel->dateDocumentText}}</div>
                                <div class="col-2"><strong>Особые отметки</strong></div>
                                <div class="col-2">{{$pts->eventModel->marks}}</div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Цвет</strong></div>
                                <div class="col-2">{{$pts->eventModel->color}}</div>
                                <div class="col-1"><strong>Сумма</strong></div>
                                <div class="col-1">{{$pts->toPayment->sum}}</div>
                                <div class="col-2"><strong>Номер документа</strong></div>
                                <div class="col-5">{{$pts->eventModel->number}}</div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Комментарий</strong></div>
                                <div class="col-11">{{$pts->comment}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            @if(count($carSts))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>СТС </strong>
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить СТС" href="/rentEvent/{{config('rentEvent.eventSts')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carSts as $sts)
                    <div class="row row-table">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-1">
                                    <a href="/rentEvent/{{$sts->eventId}}/{{$sts->dataId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                                    <strong>Дата</strong>
                                </div>
                                <div class="col-1">{{$sts->dateText}}</div>
                                <div class="col-1"><strong>Субьект</strong></div>
                                <div class="col-2">{{$sts->eventModel->subject->nickname}}</div>
                                <div class="col-1"><strong>Владелец</strong></div>
                                <div class="col-2">{{$sts->eventModel->subjectOwner->nickname}}</div>
                                <div class="col-3"></div>
                                <div class="col-1">
                                    <a href="/file/fileInfoDialog/{{$sts->uuid}}" class="btn btn-ssm @if($sts->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Выдан</strong></div>
                                <div class="col-1">{{$sts->eventModel->dateDocumentText}}</div>
                                <div class="col-2"><strong>Регистрационный знак</strong></div>
                                <div class="col-1">{{$sts->eventModel->regNumber}}</div>
                                <div class="col-2"><strong>Особые отметки</strong></div>
                                <div class="col-2">{{$sts->eventModel->marks}}</div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Цвет</strong></div>
                                <div class="col-2">{{$sts->eventModel->color}}</div>
                                <div class="col-1"><strong>Сумма</strong></div>
                                <div class="col-1">{{$sts->toPayment->sum}}</div>
                                <div class="col-2"><strong>Номер документа</strong></div>
                                <div class="col-5">{{$sts->eventModel->number}}</div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Комментарий</strong></div>
                                <div class="col-11">{{$sts->comment}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
             @if(count($carOsago))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> 
                        <strong>ОСАГО </strong>
                        <a class="btn btn-ssm btn-outline-success " title="Добавить ОСАГО" href="/rentEvent/{{config('rentEvent.eventOsago')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carOsago as $insurance)
                   @include('motorPool.carInfoInsurance');
                @endforeach
            @endif
            @if(count($carKasko))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>КАСКО </strong>
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить КАСКО" href="/rentEvent/{{config('rentEvent.eventKasko')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carKasko as $insurance)
                  @include('motorPool.carInfoInsurance');
                @endforeach
            @endif
            @if(count($carDiagnosticCard))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Диаг Карта </strong>
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить диагностическую карту" href="/rentEvent/{{config('rentEvent.eventDiagnosticCard')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carDiagnosticCard as $insurance)
                    @include('motorPool.carInfoInsurance');
                @endforeach
            @endif
            @if(count($carProxy))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Доверенность</strong>
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить доверенность" href="/rentEvent/{{config('rentEvent.eventProxy')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carProxy as $insurance)
                   @include('motorPool.carInfoInsurance');
                @endforeach
            @endif
            @if(count($carLicense))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Лицензия</strong>
                        <a class="btn btn-ssm btn-outline-success ml-3" title="Добавить лицензию" href="/rentEvent/{{config('rentEvent.eventLicense')}}/create?carId={{$car->id}}&needParent=1"><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
                @foreach($carLicense as $insurance)
                    @include('motorPool.carInfoInsurance');
                @endforeach
            @endif
        </div>
    </div>

@endsection
