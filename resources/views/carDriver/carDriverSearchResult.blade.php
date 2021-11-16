@foreach($carDrivers as $carDriver)
    <div class="row row-table">
        <div class="col-sm-4">{{$carDriver->surname}} {{$carDriver->name}} {{$carDriver->patronymic}}</div>
        <div class="col-sm-3">{{$carDriver->birthday}}</div>
        @if($carDriver->contacts->count())
            <div class="col-sm-4" title="@foreach($carDriver->contacts as $contact) {{$contact->phone}} @endforeach">
                {{$carDriver->contacts[0]->phone}}
            </div>
            @else
            <div class="col-sm-4">Не добавлен</div>
        @endif
        <div class="col-sm-1">
            <button class="btn btn-ssm btn-outline-success driverSearch" data-driverSeachText="{{$carDriver->surname}} {{$carDriver->name}} {{$carDriver->patronymic}}" data-driverSearchId="{{$carDriver->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>

    </div>
@endforeach
