@foreach($carDrivers as $carDriver)
    <div class="row">
        <div class="col-2">{{$carDriver->surname}}</div>
        <div class="col-2">{{$carDriver->name}}</div>
        <div class="col-2">{{$carDriver->patronymic}}</div>
        <div class="col-2">{{$carDriver->birthday}}</div>
        <div class="col-2">{{$carDriver->nickname}}</div>
        <div class="col-2">
            <button class="btn btn-ssm btn-outline-success driverSearch" data-driverSeachText="{{$carDriver->surname}} {{$carDriver->name}} {{$carDriver->patronymic}}" data-driverSearchId="{{$carDriver->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
