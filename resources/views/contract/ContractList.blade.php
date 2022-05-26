@extends('../adminIndex')

@php
    $contracts=$contractsCollect->get('contracts');
    $contractTypes=$contractsCollect->get('contractTypes');
    $currentContractType=$contractsCollect->get('currentContractType');
@endphp

@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0">Договора</h6>
@endsection

@section('content')
    <form method="GET" action="">
        <input type="number" name="typeId" value="{{$currentContractType->id}}" hidden/>
            <div class="form-group row">
                <label for="fromDate" class="col-form-label">От: </label>
                <div class="col-sm-2 input-group-sm">
                    <input type="date" class="form-control" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
                </div>

                <label for="toDate" class="col-form-label">До: </label>
                <div class="col-sm-2 input-group-sm">
                    <input type="date" class="form-control" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
                </div>
                <div class="col-sm-2 input-group-sm">
                    <button class="btn btn-sm btn-success" type="submit">Показать</button>
                </div>
            </div>
    </form>

    <div class="card text-center mt-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                @foreach($contractTypes as $contractType)
                    <li class="nav-item">
                        <a class="nav-link @if( $currentContractType->id==$contractType->id) active @endif" href="/contract/list?typeId={{$contractType->id}}&fromDate={{$periodDate->getStartDate()->format('Y-m-d')}}&toDate={{$periodDate->getEndDate()->format('Y-m-d')}}">{{$contractType->name}}</a>
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
                    <div class="col-2 p-0">Группа</div>
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
                                <div class="col-2">{{$contract->carGroup->nickName}}</div>
                                <div class="col-2"></div>
                                <div class="col-1 text-right">{{$contract->deposit}}</div>
                                <div class="col-1 text-right"></div>
                                <div class="col-2">{{$contract->status->name}}</div>
                                <div class="col-1 p-0 text-center">
                                    <a href="/timesheet/contract?contractId={{$contract->id}}" title="События" class="btn btn-ssm btn-outline-primary">
                                        <i class="fas fa-calendar-alt"></i>
                                    </a>
                                    <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carInfo?carId={{$contract->carId}}" title="Информация о машине"><i class="fas fa-car"></i></a>
                                    <a class="btn btn-ssm btn-outline-info DialogUser" href="/dialog/carDriverInfo?carDriverId={{$contract->driverId}}"  title="Информация о водителе"><i class="fas fa-user-tie"></i></a>
                                </div>
                            </div>

                    <div class="row">
                        <div class="col-1 p-0">

{{--                            <a href="/payment/listByContract?contractId={{$contract->id}}" title="События по договору">{{$contract->number}}</a>--}}
                                <a href="/contract/contractFullInfo?contractId={{$contract->id}}" title="События по договору">{{$contract->number}}</a>
                        </div>
                        <div class="col-2">{{$contract->finish}}</div>
                        <div class="col-2">{{$contract->car->nickName}}</div>
                        <div class="col-2"></div>
                        <div class="col-1 text-right"></div>
                        <div class="col-1 text-right"></div>
                        <div class="col-2">{{$contract->price}}</div>
                        <div class="col-1 text-center p-0 pt-1"><a class="btn btn-ssm btn-outline-warning" href="/contract/edit?contractId={{$contract->id}}" title="Редактировать"> <i class="far fa-edit"></i></a></div>
                    </div>
                    <div class="row">
                        <div class="col-1 p-0">
                            <a href="/contract/toPay?contractId={{$contract->id}}" title="К оплате по договору"><i class="fas fa-hand-holding-usd"></i></a>
{{--                            <a href="/additional/contractAdditional?contractId={{$contract->id}}" title="Услуги по договору"><i class="fas fa-tags"></i></a>--}}
                        </div>
                        <div class="col-2">{{$contract->finishFact}}</div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
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


