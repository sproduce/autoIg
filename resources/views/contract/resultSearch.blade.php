    @foreach($contracts as $contract)
        <div class="row row-table">
            <div class="col-6">{{$contract->number}}</div>
            <div class="col-4"></div>
            <div class="col-2">
                <button class="btn btn-ssm btn-outline-success carSearch" data-contractSearchText="{{$contract->number}}" data-contractSearchId="{{$contract->id}}">
                    <i class="fas fa-folder-plus"></i>
                </button>
            </div>
        </div>
    @endforeach
