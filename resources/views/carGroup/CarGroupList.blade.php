@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success DialogUserMin mr-3" title="Добавить группу" href="/carGroup/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0">Группы машин</h6>
@endsection

@section('content')

    @if($carGroups->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">
                Название
            </div>
            <div class="col-2">
                NickName
            </div>
            <div class="col-2">
                Открыта
            </div>
            <div class="col-2">
                Закрыта
            </div>

            <div class="col-2">

            </div>
        </div>


        @foreach($carGroups as $carGroup)
            <div class="row row-table">
                <div class="col-3">
                    <a href="/carGroup/fullInfo?carGroupId={{$carGroup->id}}" title="info">{{$carGroup->name}}</a>
                </div>
                <div class="col-2">
                    {{$carGroup->nickName}}
                </div>
                <div class="col-2">
                    {{$carGroup->start}}
                </div>
                <div class="col-2">
                    {{$carGroup->finish}}
                </div>

                <div class="col-2">

                </div>
            </div>

        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Группы не добавлены</h5>
            </div>
        </div>
    @endif



@endsection
