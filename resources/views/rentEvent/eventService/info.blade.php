<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Дата : </strong></div>
        <div class="col-3">{{$eventDataObj->dateTime->toDateTimeString()}}</div>
        <div class="col-3"><strong>Машина : </strong></div>
        <div class="col-3">{{$eventDataObj->carText}}</div>
    </div>
    <div class="row mt-3">
        <div class="col-3"><strong>Субьект : </strong></div>
        <div class="col-3"></div>
        <div class="col-3"><strong>Договор : </strong></div>
        <div class="col-3">{{$eventDataObj->contractNumber}}</div>
    </div>
    <div class="row mt-3">
        <div class="col-3"><strong>Сумма : </strong></div>
        <div class="col-3"></div>
        <div class="col-3"><strong>Пробег : </strong></div>
        <div class="col-3"></div>
    </div>
</div>
<div class="modal-footer">

</div>
