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
                {{$eventRentalObj->minDateTime->format('d-m-Y h:i')}}
            </div>
            <div class="col-3"><strong>Завершение аренды</strong></div>
            <div class="col-3">
                {{$eventRentalObj->maxDateTime->format('d-m-Y h:i')}}
            </div>
        </div>
        <div class="row">
            <div class="col-3"><strong> Договор</strong> </div>
            <div class="col-3">

            </div>
            <div class="col-3"><strong> Оплачено</strong> </div>
            <div class="col-3">

            </div>
        </div>
    </div>
</div>
