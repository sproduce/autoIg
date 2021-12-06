@extends('../adminIndex')

@php
    $contracts=$contractsCollect->get('contracts');
    $contractTypes=$contractsCollect->get('contractTypes');
    $currentContractFilter=$contractsCollect->get('currentContractFilter');
    //Заменить на коллекции
    $currentContractType=$currentContractFilter['typeId'];

@endphp

@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0">Договора</h6>
@endsection

@section('content')
    <form method="GET" action="">
        <div class="row">

            <div class="col-2">
                От: <input type="date" name="filterStart"/>
            </div>
            <div class="col-2">
                До: <input type="date" name="filterFinish"/>
            </div>
            <div class="col-2">
                <button class="btn btn-ssm btn-success" type="submit">Показать</button>
            </div>

        </div>
    </form>

    <div class="card text-center mt-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach($contractTypes as $contractType)
                    <li class="nav-item">
                        <a class="nav-link @if( $currentContractType->id==$contractType->id) active @endif" href="/contract/list?typeId={{$contractType->id}}">{{$contractType->name}}</a>
                    </li>
                @endforeach

            </ul>
        </div>
        <div class="card-body">



    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active">Актуальные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="/contract/completedList">Завершенные</a>
                </li>
            </ul>
        </div>
        <div class="card-body">

            @if($contracts->count())
                <div class="row align-items-center font-weight-bold border">
                    <div class="col-1 p-0">Номер</div>
                    <div class="col-2 p-0">Даты</div>
                    <div class="col-2 p-0">Автомобиль</div>
                    <div class="col-2 p-0">Водитель</div>
                    <div class="col-1 p-0">Депозит</div>
                    <div class="col-1 p-0">Баланс</div>
                    <div class="col-2 p-0">??</div>
                    <div class="col-1"></div>
                </div>
                @foreach($contracts as $contract)
                    <div class="row row-table">
                        <div class="col-12">
                    <div class="row">
                        <div class="col-1 text-left pl-0">
                            {{$loop->iteration}}.
                        </div>
                        <div class="col-2">{{$contract->start}}</div>
                        <div class="col-2">{{$contract->car->generation->model->brand->name}}</div>
                        <div class="col-2">{{$contract->driver->surname}}</div>
                        <div class="col-1 text-right">{{$contract->deposit}}</div>
                        <div class="col-1 text-right">{{$contract->balance}}</div>
                        <div class="col-2">{{$contract->status->name}}</div>
                        <div class="col-1 p-0">
                            <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carInfo?carId={{$contract->carId}}" title="Информация о машине"><i class="fas fa-car"></i></a>
                            <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carDriverInfo?carDriverId={{$contract->driverId}}"  title="Информация о водителе"><i class="fas fa-user-tie"></i></a>
                            <div class="float-right">
                                <a class="btn btn-ssm btn-outline-warning" href="/contract/edit?contractId={{$contract->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-1 p-0">{{$contract->number}}</div>
                        <div class="col-2">{{$contract->finish}}</div>
                        <div class="col-2">{{$contract->car->generation->model->name}}</div>
                        <div class="col-2">{{$contract->driver->name}}</div>
                        <div class="col-1 text-right"></div>
                        <div class="col-1 text-right"></div>
                        <div class="col-2">{{$contract->tariff->name}}</div>
                        <div class="col-1"></div>
                    </div>
                    <div class="row">
                        <div class="col-1 p-0"></div>
                        <div class="col-2">{{$contract->finishFact}}</div>
                        <div class="col-2">{{$contract->car->nickName}}</div>
                        <div class="col-2">{{$contract->driver->nickname}}</div>
                        <div class="col-1 text-right"></div>
                        <div class="col-1 text-right"></div>
                        <div class="col-2"></div>
                        <div class="col-1"></div>
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

                </div>
            </div>
        </div>
    </div>
        </div>











@endsection


