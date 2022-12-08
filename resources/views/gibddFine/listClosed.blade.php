@extends('../adminIndex')


@section('header')

    <h6>Оплаченные штрафы</h6>

@endsection

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active">Актуальные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Оплаченные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Все</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            @if($finesObj->count())
            <div class="row align-items-center font-weight-bold border">
                <div class="col-1">Машина</div>
                <div class="col-2">Номер постановления</div>
                <div class="col-2">Время нарушения</div>
                <div class="col-1">Сумма</div>
                <div class="col-3">Место нарушения</div>
                <div class="col-2">Дата обновления</div>
                <div class="col-1"></div>
            </div>
            
            @foreach($finesObj as $fine)
                <div class="row border-top mt-1">
                    <div class="col-1 text-right p-0">{{$fine->regnumber}}</div>
                    <div class="col-2">{{$fine->decreeNumber}}</div>
                    <div class="col-2"> @if($fine->dateTimeFine){{$fine->dateTimeFine->format('d-m-Y H:i')}} @endif</div>
                    <div class="col-1">{{$fine->sum}} p.</div>
                    <div class="col-2" title="{{$fine->koap}}">{{$fine->place}}</div>
                    <div class="col-2">@if($fine->closed) Оплачен @endif {{$fine->dateFile->format('d-m-Y')}}</div>
                    <div class="col-1">
                        @if($fine->timeSheetId)
                            <a href="" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить штраф?')"><i class="fas fa-trash"></i> </a>
                        @endif
                    </div>
                </div>
            @endforeach
            
            @endif
        </div>
    </div>
   


@endsection


