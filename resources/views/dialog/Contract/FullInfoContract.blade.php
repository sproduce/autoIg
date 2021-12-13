<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о договоре</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Начало договора</strong></div>
        <div class="col-3">{{$contract->start}}</div>
        <div class="col-3"><strong>Водитель</strong></div>
        <div class="col-3">{{$contract->driver->name}} {{$contract->driver->name}} {{$contract->driver->nickname}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Окончание договора</strong></div>
        <div class="col-3">{{$contract->finish}}</div>
        <div class="col-3"><strong>Машина</strong></div>
        <div class="col-3">{{$contract->car->generation->name}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Факт окончание</strong></div>
        <div class="col-3">{{$contract->finishFact}}</div>
        <div class="col-3"><strong>Статус договора</strong></div>
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Номер договора</strong></div>
        <div class="col-3">{{$contract->number}}</div>
        <div class="col-3"><strong>Баланс</strong></div>
        <div class="col-3">{{$contract->balance}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Тип договора</strong></div>
        <div class="col-3">{{$contract->type->name}}</div>
        <div class="col-3"><strong>Тариф договора</strong></div>
        <div class="col-3">{{$contract->tariff->name}}</div>
    </div>


<div class="modal-footer d-flex justify-content-center">




</div>

</div>
