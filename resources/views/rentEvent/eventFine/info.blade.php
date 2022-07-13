<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Дата нарушения: </strong></div>
        <div class="col-3">{{$eventDataObj->dateTimeFine->toDateTimeString()}}</div>
        <div class="col-3"><strong>Сумма / Скидка : </strong></div>
        <div class="col-3">{{$eventDataObj->sum}} / {{$eventDataObj->sumSale}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Оплатить со скидкой: </strong></div>
        <div class="col-3">{{$eventDataObj->datePaySale ? $eventDataObj->datePaySale->toDateTimeString() : ''}}</div>
        <div class="col-3"></div>
        <div class="col-3"></div>


    </div>
</div>
<div class="modal-footer">

</div>
