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

<div class="modal-body">
    <div class="container-fluid">
        <div class="form-group row">
            <label for="car" class="col-sm-2 col-form-label form-control-sm">Машина</label>
            <div class="col-sm-4">
                <input type="text" class="form-control form-control-sm" id="car" name="car" autocomplete="off" value="{{$car->nickName}}" readonly />
            </div>
            <label for="sum" class="col-sm-2 col-form-label form-control-sm">Сумма</label>
            <div class="col-sm-4">
                <input type="number" class="form-control form-control-sm" id="sum" name="sum" autocomplete="off" value="{{$toPayment->sum}}" required/>
            </div>
        </div>
        @if (isset($contracts[0]))
        <div class="form-group row ">
            <label for="contract" class="col-sm-2 col-form-label form-control-sm">Договор</label>
            {{$contracts[0]->number}}
        </div>
        @endif

        <div class="form-group row ">
            <label for="comment" class="col-sm-2 col-form-label form-control-sm">Комментарий</label>
            <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="comment" name="comment" autocomplete="off"/>
            </div>
        </div>

    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-primary">Добавить</button>
</div>

