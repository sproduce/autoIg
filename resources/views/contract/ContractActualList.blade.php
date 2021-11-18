@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Договора</h6>
@endsection

@section('content')


    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active">Актуальные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contract/completedList">Завершенные</a>
                </li>
            </ul>
        </div>
        <div class="card-body">

            @if($contracts->count())
                <div class="row align-items-center font-weight-bold border">
                    <div class="col-1 p-0">Номер</div>
                    <div class="col-2 p-0">Дата начала</div>
                    <div class="col-2 p-0">Дата окончания</div>
                    <div class="col-2 p-0">Фактическая дата</div>
                    <div class="col-1 p-0">Депозит</div>
                    <div class="col-1 p-0">Баланс</div>
                    <div class="col-1 p-0">Статус</div>
                </div>
                @foreach($contracts as $contract)
                    <div class="row row-table">
                        <div class="col-1">{{$contract->number}}</div>
                        <div class="col-2">{{$contract->start}}</div>
                        <div class="col-2">{{$contract->finish}}</div>
                        <div class="col-2">{{$contract->finishFact}}</div>
                        <div class="col-1 text-right">{{$contract->deposit}}</div>
                        <div class="col-1 text-right">{{$contract->balance}}</div>
                        <div class="col-1">{{$contract->status->name}}</div>
                        <div class="col-2">
                            <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carInfo?carId={{$contract->carId}}" title="Информация о машине"><i class="fas fa-car"></i></a>
                            <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carDriverInfo?carDriverId={{$contract->driverId}}"  title="Информация о водителе"><i class="fas fa-user-tie"></i></a>
                            <div class="float-right">
                                <a class="btn btn-ssm btn-outline-warning" href="/contract/edit?contractId={{$contract->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            </div>
                        </div>
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
                <div class="col-12 text-left">
                    <a class="btn btn-ssm btn-outline-success" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
                </div>
            </div>
        </div>
    </div>











@endsection


