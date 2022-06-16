@php
    $contracts=$toPayDataCol->get('contracts');
    $car=$toPayDataCol->get('car');
    $toPayment=$toPayDataCol->get('toPayment');

@endphp




<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form action="/payment/copyToPayClient" method="POST">

    @csrf
    <input type="number" name="toPaymentId" value="{{$toPayment->id}}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label for="sum" class="col-sm-2 col-form-label form-control-sm">Сумма</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="sum" name="sum" autocomplete="off" value="{{$toPayment->sum}}" required/>
                </div>
            </div>

            @forelse ($contracts as $contract)
                <div class="form-group row">
                    <div class="col-1">
                        <input type="radio" name="contractId" value="{{$contract->id}}"/>
                    </div>
                    <div class="col-4">{{$contract->number}}</div>
                    <div class="col-4"></div>
                    <div class="col-3">{{$contract->car->nickName}}</div>
                </div>
            @empty
                <div class="form-group row">
                    Договора не найдены
                </div>
            @endforelse

            <div class="form-group row ">
                <label for="comment" class="col-sm-2 col-form-label form-control-sm">Комментарий</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="comment" name="comment" value="{{$toPayment->comment}}" autocomplete="off"/>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Добавить</button>
    </div>
</form>
