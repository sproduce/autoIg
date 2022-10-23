    <div class="modal-header text-center">
        <div class="row w-100">
            <div class="col-2"></div>
            <div class="col-4"><strong>Машина </strong> {{$carObj->nickName}}</div>
            <div class="col-4"><strong>Дата </strong> {{$carIdDate['date']->format('d-m-Y')}}</div>
            <div class="col-1"></div>

            <div class="col-1"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button></div>
        </div>


    </div>
    <div class="modal-body">
        @if($timeSheets->isEmpty())
            <div class="row">
                <div class="col-12 text-center"><strong>События не найдены</strong></div>
            </div>
        @else
            <div class="row align-items-center font-weight-bold mb-2">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2">Событие</div>
                        <div class="col-2 p-0">Дата начала</div>
                        <div class="col-2">Договор</div>
                        <div class="col-2">Стоимость</div>
                        <div class="col-2">Пробег</div>
                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-2 p-0">Дата окончания</div>
                        <div class="col-2"></div>
                        <div class="col-2">Оплачено</div>
                        <div class="col-2"></div>
                    </div>
                </div>

            </div>

            @foreach($timeSheets as $timeSheet)
            <div class="row row-table @if (!$loop->first) border-top border-dark @endif" data-timesheetid="{{$timeSheet->timeSheetId}}">
                <div class="col-12">
                    <div class="row">
                        <div class="col-2" style="background-color:{{$timeSheet->eventColor}}">{{$timeSheet->eventName}}</div>
                        <div class="col-2 p-0" title="">{{$timeSheet->timeSheetDateTime->format('d-m-Y H:i')}}</div>
                        <div class="col-2"><i class="fas fa-info-circle text-primary"
                                              title="{{$timeSheet->contract->subjectFrom->nickname}}&#013;{{$timeSheet->contract->subjectTo->nickname}}&#013;{{$timeSheet->contract->status->name}}&#013;{{$timeSheet->contract->type->name}}">
                            </i> {{$timeSheet->contractNumber}}</div>
                        <div class="col-2 text-right">{{$timeSheet->toPaymentSum}} p.</div>
                        <div class="col-2"></div>
                        <div class="col-1"></div>
                        <div class="col-1 p-0">
                            @if($timeSheet->toPaymentPaymentSum)
                                <a class="btn-ssm btn-outline-info" title="Платежи" href="/payment/toPaymentInfo/{{$timeSheet->toPaymentId}}"><i class="fas fa-info-circle"></i></a>
                            @endif
                            <a class="btn-ssm btn-outline-success" href="/timesheet/add?carId={{$carIdDate['carId']}}&date={{$carIdDate['date']->toDateString()}}&parentId={{$timeSheet->timeSheetId}}" title="Добавить событие наследник">
                                <i class="fas fa-folder-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-2 p-0" title="">{{$timeSheet->timeSheetDateTime->addMinute($timeSheet->timeSheetDuration)->format('d-m-Y H:i')}}</div>
                        <div class="col-2"></div>
                        <div class="col-2 text-right">{{$timeSheet->toPaymentPaymentSum}} p.</div>
                        <div class="col-2"></div>
                        <div class="col-1"></div>
                        <div class="col-1 p-0">
                            <a class="btn-ssm btn-outline-warning" href="/rentEvent/{{$timeSheet->timeSheetEventId}}/{{$timeSheet->timeSheetDataId}}/edit?needParent=1" title="Редактировать событие">
                                <i class="far fa-edit"></i>
                            </a>
                            <a class="btn-ssm btn-outline-danger" onclick="return confirm('Удалить событие?');" href="/rentEvent/{{$timeSheet->timeSheetEventId}}/{{$timeSheet->timeSheetDataId}}/destroy" title="Удалить событие">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
            @endforeach
        @endif
    </div>

    <div class="modal-footer d-flex justify-content-center">
        @foreach($rentEventObjs as $rentEventObj)
            @if($rentEventObj->visibleTimeSheet)
                <a href="/rentEvent/{{$rentEventObj->id}}/create?carId={{$carIdDate['carId']}}&date={{$carIdDate['date']->format('Y-m-d')}}&needParent=1" class="btn btn-sm" style="color:{{$rentEventObj->color}}"><i class="far fa-plus-square"></i> {{$rentEventObj->name}}</a>
            @endif
        @endforeach
    </div>




