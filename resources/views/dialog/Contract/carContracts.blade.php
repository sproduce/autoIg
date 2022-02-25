<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Договора по машине</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <form action="" method="POST">
    @forelse ($contractsObj as $contract)
    <div class="row">
        <div class="col-3"><strong>Начало договора</strong></div>
        <div class="col-2 p-0">{{$contract->start->format('d-m-Y')}}</div>
        <div class="col-2 p-0"><strong>Номер договора</strong></div>
        <div class="col-2 p-0">{{$contract->number}}</div>
        <div class="col-1 p-0"><strong>Баланс</strong></div>
        <div class="col-1 p-0">{{$contract->balance}}</div>
        <div class="col-1 text-right"><input type="radio" name="contractId" value="{{$contract->contractId}}"></div>
    </div>
    @empty
        Договора по машине не найдены
    @endforelse
</div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" value="Добавить"/>
    </div>
    </form>

