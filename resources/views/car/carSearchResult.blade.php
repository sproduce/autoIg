@foreach($cars as $car)
    <div class="row row-table">
        <div class="col-6">{{$car->nickName}} {{$car->regNumber}}</div>
        <div class="col-4"></div>
        <div class="col-2">
            <button class="btn btn-ssm btn-outline-success carSearch" data-carSeachText="{{$car->generation->model->brand->name}} {{$car->generation->model->name}} {{$car->generation->name}} {{$car->regNumber}} {{$car->color}} {{$car->nickName}}" data-carSearchId="{{$car->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
