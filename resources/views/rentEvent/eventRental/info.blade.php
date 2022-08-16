<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-2"><strong>Машина: </strong></div>
        <div class="col-2">{{$eventDataObj->carText}}</div>
        <div class="col-2"><strong>Договор: </strong></div>
        <div class="col-2">{{$eventDataObj->contractNumber}}</div>
        <div class="col-2"><strong>Длительность: </strong></div>
        <div class="col-2">{{$eventDataObj->duration}}</div>
    </div>
    <div class="row mt-3">
        <div class="col-3"><strong>Начало аренды: </strong></div>
        <div class="col-3">{{$eventDataObj->dateTime->toDateTimeString()}}</div>
        <div class="col-2"><strong>Стоимость: </strong></div>
        <div class="col-2">{{$eventDataObj->sum}}</div>
    </div>
</div>
<div class="modal-footer">

</div>

