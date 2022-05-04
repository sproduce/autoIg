    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Подробно</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row align-items-center font-weight-bold">
            <div class="col-3">Событие</div>
            <div class="col-4">Дата</div>
{{--            <div class="col-1">Сумма</div>--}}
            <div class="col-2">Пробег</div>
            <div class="col-3">Договор</div>

        </div>

        @foreach($timeSheets as $timeSheet)
        <div class="row row-table">
            <div class="col-3" style="background-color:{{$timeSheet->event->color}}">{{$timeSheet->event->name}}</div>
            <div class="col-4" title="{{$timeSheet->comment}}">
                {{$timeSheet->dateTime->format('d-m-Y H:i')}}
                @if ($timeSheet->date_time_end)
                    - {{$timeSheet->date_time_end->format('d-m-Y H:i')}}
                @endif
            </div>
{{--            <div class="col-1">{{round($timeSheet->duration/60)}}</div>--}}
{{--            <div class="col-1">{{$timeSheet->sum}}</div>--}}
            <div class="col-2">{{$timeSheet->mileage}}</div>
            <div class="col-3">{{$timeSheet->contract->number}}</div>

        </div>
        @endforeach
    </div>

    <div class="modal-footer d-flex justify-content-center">
        @foreach($rentEventObjs as $rentEventObj)
            <a href="/{{$rentEventObj->action}}/create?carId={{$carIdDate['carId']}}&date={{$carIdDate['date']->format('Y-m-d')}}&needParent=1" class="btn btn-sm" style="color:{{$rentEventObj->color}}"><i class="far fa-plus-square"></i> {{$rentEventObj->name}}</a>
        @endforeach
    </div>




