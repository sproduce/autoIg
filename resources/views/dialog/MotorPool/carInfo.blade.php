    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Информация о машине</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

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
                        <div class="col-md-3">{{$carGroup->group->name}}</div>
                        <div class="col-md-2"><strong>Начало</strong></div>
                        <div class="col-md-2">{{$carGroup->startText}}</div>
                        <div class="col-md-2"><strong>Окончание</strong></div>
                        <div class="col-md-2">{{$carGroup->finishText}}</div>
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
                    <div class="col-12 text-center"> <strong>ПТС </strong></div>
                </div>
                @foreach($carPts as $pts)
                    <div class="row">
                        <div class="col-2"><strong>Дата</strong></div>
                        <div class="col-2">{{$pts->eventModel->dateDocumentText}}</div>
                        <div class="col-2"><strong>Субьект</strong></div>
                        <div class="col-2">{{$pts->eventModel->subject->nickname}}</div>
                        <div class="col-2"><strong>Владелец</strong></div>
                        <div class="col-2">{{$pts->eventModel->subjectOwner->nickname}}</div>
                    </div>
                @endforeach
            @endif
            @if(count($carSts))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>СТС </strong></div>
                </div>
                @foreach($carSts as $sts)
            <div class="row">
                <div class="col-2"><strong>Дата</strong></div>
                <div class="col-2">{{$sts->eventModel->dateDocumentText}}</div>
                <div class="col-2"><strong>Субьект</strong></div>
                <div class="col-2">{{$sts->eventModel->subject->nickname}}</div>
                <div class="col-2"><strong>Владелец</strong></div>
                <div class="col-2">{{$sts->eventModel->subjectOwner->nickname}}</div>
            </div>
                @endforeach
            @endif
             @if(count($carOsago))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>ОСАГО </strong></div>
                </div>
                @foreach($carOsago as $osago)
                    <div class="row">
                        <div class="col-1"><strong>Дата</strong></div>
                        <div class="col-3 p-0">{{$osago->eventModel->dateDocumentText}} по {{$osago->eventModel->expirationText}}</div>
                    </div>
                @endforeach
            @endif
            @if(count($carKasko))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>КАСКО </strong></div>
                </div>
                @foreach($carKasko as $ksako)
                    <div class="row">
                        <div class="col-1"><strong>Дата</strong></div>
                        <div class="col-3 p-0">{{$ksako->eventModel->dateDocumentText}} по {{$ksako->eventModel->expirationText}}</div>
                    </div>
                @endforeach
            @endif
            @if(count($carDiagnosticCard))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Диаг Карта </strong></div>
                </div>
                @foreach($carDiagnosticCard as $diagnosticCard)
                    <div class="row">
                        <div class="col-1"><strong>Дата</strong></div>
                        <div class="col-3 p-0">{{$diagnosticCard->eventModel->DateDocumentText}} по {{$diagnosticCard->eventModel->expirationText}}</div>
                    </div>
                @endforeach
            @endif
            @if(count($carProxy))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Доверенность</strong></div>
                </div>
                @foreach($carProxy as $proxy)
                    <div class="row">
                        <div class="col-1"><strong>Дата</strong></div>
                        <div class="col-3 p-0">{{$proxy->eventModel->dateDocumentText}} по {{$proxy->eventModel->expirationText}}</div>
                    </div>
                @endforeach
            @endif
            @if(count($carLicense))
                <div class="row border-top mt-2 mb-2 pt-2">
                    <div class="col-12 text-center"> <strong>Лицензия</strong></div>
                </div>
                @foreach($carLicense as $license)
                    <div class="row">
                        <div class="col-1"><strong>Дата</strong></div>
                        <div class="col-3 p-0">{{$license->eventModel->dateDocumentText}} по {{$license->eventModel->expirationText}}</div>
                        <div class="col-2"><strong>Субьект</strong></div>
                        <div class="col-2 p-0">{{$license->eventModel->subject->nickname}}</div>
                        <div class="col-2"><strong>Субьект</strong></div>
                        <div class="col-2 p-0">{{$license->eventModel->subjectTo->nickname}}</div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>


