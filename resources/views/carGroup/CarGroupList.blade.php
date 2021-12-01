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
                Начало
            </div>
            <div class="col-2">
                Завершение
            </div>

            <div class="col-2">

            </div>
        </div>


        @foreach($carDrivers as $carDriver)
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Группы не добавлены</h5>
            </div>
        </div>
    @endif



@endsection
