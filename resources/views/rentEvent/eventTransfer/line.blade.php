<div class="row row-table @if($event->deleted_at)deleteLine @endif" data-event="{{$event->eventId}}" data-id="{{$event->dataId}}">
            <div class="col-2 text-right">
                <a href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->dateTime->format("d-m-y")}} {{$event->dateTime->format("H:i")}}
                @if($event->dateTimeEnd)
                    <br/>
                    <span title="Оплатить до">
                        {{$event->dateTimeEnd->format("d-m-y")}} {{$event->dateTimeEnd->format("H:i")}}
                    </span>
                @endif
            </div>

            <div class="col-2">
                @if($event->carId)
                    <a href="/motorPool/carInfoDialog/{{$event->carId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    {{$event->carNickName}}
                @endif
            </div>
            <div class="col-1">
                {{$event->eventObj->name}}
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col-5 text-right p-0">{{$event->toPaymentSum}}p.</div>
                    <div class="col-1 p-0"></div>
                    <div class="col-5 text-right p-0">{{$event->toPaymentPaymentSum}}p.</div>
                </div>
            </div>
            <div class="col-4">
                {{$event->comment}}
            </div>
            <div class="col-1 text-right">
                @if(!$event->deleted_at)
                    <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
                @endif
            </div>

        </div>