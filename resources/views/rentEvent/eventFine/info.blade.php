<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Дата: </strong></div>
        <div class="col-3">{{$eventDataObj->dateTime->toDateTimeString()}}</div>
        <div class="col-3"><strong>Машина: </strong></div>
        <div class="col-3">{{$eventDataObj->carText}}</div>
    </div>

    <div class="row mt-3">
        <div class="col-3"><strong>Оплатить: </strong></div>
        <div class="col-3">
            {{$eventDataObj->sumSale}}
            <strong>До: </strong>
            {{$eventDataObj->datePaySale ? $eventDataObj->datePaySale->toDateString() : ''}}

        </div>
        <div class="col-3"><strong>Оплатить: </strong></div>
        <div class="col-3">
            {{$eventDataObj->sum}}
            <strong>До: </strong>
            {{$eventDataObj->datePayMax ? $eventDataObj->datePayMax->toDateString(): ''}}
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-2"><strong>УИН: </strong></div>
        <div class="col-10">{{$eventDataObj->uin}}</div>
    </div>
    <div class="row mt-3">
        <div class="col-2"><strong>Комментарий: </strong></div>
        <div class="col-10">{{$eventDataObj->comment}}</div>
    </div>
    @include('rentEvent.fileInfo')
</div>
<div class="modal-footer">
    
</div>
