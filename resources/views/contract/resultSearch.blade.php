@if ($contracts->isEmpty())
    <div class="row align-items-center font-weight-bold border-top">
        <div class="col-12 text-center">По таким параметрам договора не найдены</div>
    </div>
@else
    <div class="row align-items-center font-weight-bold border-top text-center">
        <div class="col-2">Номер</div>
        <div class="col-4">Субьект</div>
        <div class="col-2">Авто</div>
        <div class="col-2">Тариф</div>
        <div class="col-2"></div>
    </div>
    <div class="row align-items-center font-weight-bold border-bottom text-center">
        <div class="col-2">Статус</div>
        <div class="col-4"></div>
        <div class="col-2">Группа</div>
        <div class="col-2">Дата</div>
        <div class="col-2"></div>
    </div>

    @foreach($contracts as $contract)
        <div class="row row-table">
            <div class="col-12">
                <div class="row">
                    <div class="col-2">{{$contract->number}}</div>
                    <div class="col-4 p-0">{{$contract->subjectFromNickname}}</div>
                    <div class="col-2 p-0">{{$contract->carNickName}}</div>
                    <div class="col-2 text-right">@if($contract->price) {{$contract->price}} p. @endif</div>
                    <div class="col-2">
                        <button class="btn btn-ssm btn-outline-success carSearch" data-contractSearchText="{{$contract->number}}" data-contractSearchId="{{$contract->id}}">
                            <i class="fas fa-folder-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">{{$contract->statusName}}</div>
                    <div class="col-4 p-0">{{$contract->subjectToNickname}}</div>
                    <div class="col-2 p-0">{{$contract->carGroupNickName}}</div>
                    <div class="col-2 text-right">{{$contract->start->format('d-m-Y')}}</div>
                    <div class="col-2"></div>
                </div>
            </div>
        </div>
    @endforeach
@endif
