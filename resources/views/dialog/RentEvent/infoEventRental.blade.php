<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3"><strong>Начало аренды</strong></div>
            <div class="col-3">
                {{$eventRentalObj->timeSheetMinDateTime->format('d-m-Y h:i')}}
            </div>
            <div class="col-3"><strong>Завершение аренды</strong></div>
            <div class="col-3">
                {{$eventRentalObj->timeSheetMaxDateTime->format('d-m-Y h:i')}}
            </div>
        </div>
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3">
                {{$eventRentalObj->contractNumber}}
            </div>
            <div class="col-3"><strong>Водитель</strong></div>
            <div class="col-3">{{$eventRentalObj->driverSurname}} {{$eventRentalObj->driverName}}</div>
        </div>
    </div>
</div>
