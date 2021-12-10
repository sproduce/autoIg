<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о договоре</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-3">Начало договора</div>
        <div class="col-3">{{$contract->start}}</div>
        <div class="col-3">Водитель</div>
        <div class="col-3">{{$contract->driver->name}} {{$contract->driver->name}} ({{$contract->driver->nickname}})</div>
    </div>
    <div class="row">
        <div class="col-3">Окончание договора</div>
        <div class="col-3">{{$contract->finish}}</div>
        <div class="col-3">Машина</div>
        <div class="col-3">{{$contract->car->generation->name}}</div>
    </div>
    <div class="row">
        <div class="col-3">Факт окончание</div>
        <div class="col-3">{{$contract->finishFact}}</div>
        <div class="col-3">Статус договора</div>
        <div class="col-3"></div>
    </div>
    <div class="row">
        <div class="col-3">Номер договора</div>
        <div class="col-3">{{$contract->number}}</div>
        <div class="col-3">Баланс</div>
        <div class="col-3">{{$contract->balance}}</div>
    </div>
    <div class="row">
        <div class="col-3">Тип договора</div>
        <div class="col-3">{{$contract->type->name}}</div>
        <div class="col-3">Тариф договора</div>
        <div class="col-3">{{$contract->type->name}}</div>
    </div>


<div class="modal-footer d-flex justify-content-center">




</div>

</div>
