<div class="row align-items-center font-weight-bold border">
    <div class="col-2">Номер</div>
    <div class="col-2">Субьект</div>
    <div class="col-2">Авто</div>
    <div class="col-2">Статус</div>
    <div class="col-2">Дата</div>
    <div class="col-1"></div>
    <div class="col-1"></div>


</div>
@foreach($contracts as $contract)
        <div class="row row-table">
            <div class="col-2">{{$contract->number}}</div>
            <div class="col-2"></div>
            <div class="col-2">{{$contract->carNickName}}</div>
            <div class="col-2"></div>
            <div class="col-2">{{$contract->start->format('d-m-Y')}}</div>
            <div class="col-1"></div>
            <div class="col-1">
                <button class="btn btn-ssm btn-outline-success carSearch" data-contractSearchText="{{$contract->number}}" data-contractSearchId="{{$contract->id}}">
                    <i class="fas fa-folder-plus"></i>
                </button>
            </div>
        </div>
    @endforeach
