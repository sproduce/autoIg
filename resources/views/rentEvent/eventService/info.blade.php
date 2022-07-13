<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-2"><strong>Дата : </strong></div>
        <div class="col-2">{{$eventDataObj->dateTime->toDateTimeString()}}</div>
        <div class="col-2"><strong>Сумма : </strong></div>
        <div class="col-2">{{$eventDataObj->sum}}</div>

    </div>
</div>
<div class="modal-footer">

</div>
