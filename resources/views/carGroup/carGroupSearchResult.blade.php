@foreach($carGroups as $carGroup)
    <div class="row row-table">
        <div class="col-6">{{$carGroup->name}}</div>
        <div class="col-4"></div>
        <div class="col-2">
            <button class="btn btn-ssm btn-outline-success carGroupSearch" data-carGroupSearchText="{{$carGroup->nickName}}" data-carGroupSearchId="{{$carGroup->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
