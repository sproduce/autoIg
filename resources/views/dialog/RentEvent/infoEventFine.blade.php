<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <strong>Дата постановления</strong>
            </div>
            <div class="col-md-2">
                {{$eventFineObj->dateTimeOrder->format('d-m-Y')}}
            </div>

            <div class="col-md-4">
                <strong>Дата нарушения</strong>
            </div>
            <div class="col-md-2 p-0">
                {{$eventFineObj->dateTimeFine->format('d-m-Y H:i')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>УИН</strong>
            </div>
            <div class="col-md-8">
                {{$eventFineObj->uin}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <strong>Срок оплаты со скидкой</strong>
            </div>
            <div class="col-md-2">
                {{$eventFineObj->datePaySale->format('d-m-Y')}}
            </div>

            <div class="col-md-4">
                <strong>Максимальный срок оплаты</strong>
            </div>
            <div class="col-md-2">
                {{$eventFineObj->datePayMax->format('d-m-Y')}}
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <strong>Сумма со скидкой</strong>
            </div>
            <div class="col-md-2">
                {{$eventFineObj->sumSale}}
            </div>

            <div class="col-md-4">
                <strong>Сумма штрафа</strong>
            </div>
            <div class="col-md-2">
                {{$eventFineObj->sum}}
            </div>
        </div>

    </div>
</div>
