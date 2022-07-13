<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$eventObj->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"><strong>Дата : </strong></div>
            <div class="col-2">{{$eventDataObj->dateTimeOther->toDateTimeString()}}</div>
            <div class="col-2"><strong>Сумма : </strong></div>
            <div class="col-2">{{$eventDataObj->sumOther}}</div>

        </div>
    </div>
</div>
<div class="modal-footer">

</div>
