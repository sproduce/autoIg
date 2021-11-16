@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Договора</h6>
@endsection

@section('content')

    @if($contracts->count())
    <div class="row align-items-center font-weight-bold border">
        <div class="col-1">Номер</div>
        <div class="col-2">Дата</div>
        <div class="col-2">Дата</div>
        <div class="col-2">Дата</div>
        <div class="col-2">Водитель</div>
        <div class="col-2">Машина</div>
    </div>
        @foreach($contracts as $contract)
            <div class="row row-table">
                <div class="col-1">{{$contract->number}}</div>
                <div class="col-2">{{$contract->start}}</div>
                <div class="col-2">{{$contract->finish}}</div>
                <div class="col-2">{{$contract->finishFact}}</div>
                <div class="col-2">{{$contract->driver->surname}} {{$contract->driver->name}} {{$contract->driver->patronymic}}</div>
                <div class="col-2">{{$contract->car->regNumber}} {{$contract->car->nickName}} {{$contract->car->color}}</div>
            </div>

        @endforeach


    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Договора не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection


