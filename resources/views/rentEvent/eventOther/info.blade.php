<div class="modal-header text-center">
    <h5 class="modal-title w-100">Событие {{$timeSheetObj->event->name}}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"><strong>Дата : </strong></div>
            <div class="col-3">{{$timeSheetObj->dateTimeText}}</div>
            <div class="col-"><strong>Сумма / Оплачено </strong></div>
            <div class="col-2">{{$timeSheetObj->toPayment->sum}} / {{$timeSheetObj->toPayment->paymentSum}}</div>

        </div>
        <div class="row mt-3">
            <div class="col-2"><strong>Комментарий: </strong></div>
            <div class="col-10">{{$timeSheetObj->comment}}</div>
        </div>
    </div>
    @include('rentEvent.fileInfo')
</div>
<div class="modal-footer">

</div>
