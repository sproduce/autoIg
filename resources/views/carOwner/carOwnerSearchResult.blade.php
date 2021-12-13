@foreach($carOwners as $carOwner)
    <div class="row row-table">
        <div class="col-4">{{$carOwner->name}}</div>
        <div class="col-4">{{$carOwner->nickName}}</div>
        <div class="col-2"></div>
        <div class="col-2">
            <button class="btn btn-ssm btn-outline-success carOwnerSearch" data-carOwnerSearchText="{{$carOwner->name}} {{$carOwner->nickName}}" data-carGroupSearchId="{{$carOwner->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
