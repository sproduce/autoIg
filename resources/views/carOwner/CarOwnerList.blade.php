@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3 DialogUserMin" title="Добавить владельца" href="/carOwner/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0">Владельцы</h6>
@endsection

@section('content')

    @if($carOwners->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">
               Имя
            </div>
            <div class="col-3">
                NickName
            </div>
            <div class="col-5">
                Комментарий
            </div>
        </div>


        @foreach($carOwners as $carOwner)
            <div class="row row-table">
                <div class="col-3">
                    {{$carOwner->name}}
                </div>
                <div class="col-3">
                    {{$carOwner->nickName}}
                </div>
                <div class="col-5">
                    {{$carOwner->comment}}
                </div>
                <div class="col-1">
                    <a class="btn btn-ssm btn-outline-warning DialogUserMin" href="/carOwner/edit?carOwnerId={{$carOwner->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                    <a href="/carOwner/delete?carOwnerId={{$carOwner->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить владельца?')"><i class="fas fa-trash"></i> </a>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Владельцы не добавлены</h5>
            </div>
        </div>
    @endif


@endsection

@section('js')

@endsection

