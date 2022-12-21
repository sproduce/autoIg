<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о договоре</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>



<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4"><strong>Начало договора </strong></div>
            <div class="col-4"><strong>Окончание договора </strong></div>
            <div class="col-4"><strong>Окончание договора по факту </strong></div>

        </div>
        <div class="row">
            <div class="col-4">{{$contract->start->format('d-m-Y H:i')}}</div>
            <div class="col-4">{{$contract->finish ? $contract->finish->format('d-m-Y H:i') : ''}}</div>
            <div class="col-4">{{$contract->finishFact ? $contract->finishFact->format('d-m-Y H:i') : ''}}</div>
        </div>
        
        <div class="row mt-3">
            <div class="col-4"><strong>Тип договора </strong></div>            
            <div class="col-4"><strong>Машина </strong></div>
            <div class="col-4"><strong>Группа машин </strong></div>
        </div>
        <div class="row">
            <div class="col-4">{{$contract->type->name}}</div>
            <div class="col-4">{{$contract->car->nickName}}</div>
            <div class="col-4">{{$contract->carGroup->nickName}}</div>
        </div>
        <div class="row mt-3">
            <div class="col-4"><strong>От кого </strong></div>
            <div class="col-4"><strong>Клиент </strong></div>
            <div class="col-4"><strong>Тариф договора </strong></div>
        </div>
        <div class="row">
            <div class="col-4">{{$contract->subjectFrom->nickname}}</div>
            <div class="col-4">{{$contract->subjectTo->nickname}}</div>
            <div class="col-4">{{$contract->price}}</div>
        </div>
        
        
        <div class="row mt-3">
            <div class="col-4"><strong>Статус договора </strong></div>
            <div class="col-8"><strong>Комментарий </strong></div>
        </div>
        <div class="row ">
            <div class="col-4">{{$contract->status->name}}</div>
            <div class="col-8">{{$contract->comment}}</div>
        </div>
        
        
        
    </div>
</div>

