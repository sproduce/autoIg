@extends('../adminIndex')


@section('header')
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
                    <a href="/dialog/carInfo?carId={{$car->id}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    {{$car->generation->model->brand->name}} | {{$car->generation->model->name}}
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

                <div class="col-3">
                    {{$car->nickName}}
                </div>
                <div class="col-1">
                    <a href="" title="Документы" class="btn btn-ssm btn-outline-success">
                        <i class="far fa-file-alt"></i>
                    </a>
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

    <div class="row mt-4">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUser" title="Добавить машину" href="/motorPool/add"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection


