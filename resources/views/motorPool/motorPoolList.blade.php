@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success DialogUser mr-3" title="Добавить машину" href="/motorPool/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0">Машины </h6>
    <input type="text" class="h-50 ml-3" name="queryText" id="queryText" title="быстрый поиск"/>
@endsection


@section('content')

    @if($carsPool->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3 text-center">
                Марка | Модель
            </div>
            <div class="col-1">
                Год
            </div>
            <div class="col-1">
                Гос.Номер
            </div>
            <div class="col-3">
                Цвет
            </div>
            <div class="col-4">
                Nickname
            </div>
        </div>
        @foreach ($carsPool as $car)
            <div class="row row-table">
                <div class="col-3 pl-0">
                    <a href="/motorPool/carInfo/{{$car->id}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    {{$car->generation->model->brand->name}} | {{$car->generation->model->name}}
                    @if ($car->linkCarGroup->count())
                        <div class="float-right">
                            <i class="fas fa-users-cog" title="Принадлежит к группе машин"></i>
                        </div>
                    @endif
                </div>
                <div class="col-1">
                    {{$car->year}}
                </div>
                <div class="col-1">
                    {{$car->regNumber}}
                </div>
                <div class="col-3">
                    {{$car->color}}
                 </div>

                <div class="col-2">
                    {{$car->nickName}}
                </div>
                <div class="col-2">
                    <a href="/timesheet/car?carId={{$car->id}}" title="События" class="btn btn-ssm btn-outline-primary">
                        <i class="fas fa-calendar-alt"></i>
                    </a>
                    <a href="" title="Документы" class="btn btn-ssm btn-outline-success">
                        <i class="far fa-file-alt"></i>
                    </a>
                    <a href="/contract/add?carId={{$car->id}}" title="Добавить договор" class="btn btn-ssm btn-outline-secondary">
                        <i class="fas fa-file-contract"></i>
                    </a>
                    <a href="/payment/addToPay?carId={{$car->id}}" title="Добавить к оплате" class="btn btn-ssm btn-outline-success DialogUserMin">
                        <i class="fas fa-hand-holding-usd"></i>
                    </a>

                    <div class="float-right">
                        <a class="btn btn-ssm btn-outline-warning DialogUser" href="/motorPool/edit?carId={{$car->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                    </div>

                </div>
            </div>
        @endforeach


    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Машины в автопарк не добавлены</h5>
            </div>
        </div>
    @endif



@endsection


