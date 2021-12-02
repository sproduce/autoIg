@extends('../adminIndex')


@section('header')

    <h6 class="m-0">Машины в группе</h6>
@endsection

@section('content')

    @if($carGroupInfo->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">
                Машина
            </div>
            <div class="col-2">
                NickName
            </div>
            <div class="col-2">
                Добавлена
            </div>
            <div class="col-2">
                Удалена
            </div>

            <div class="col-2">

            </div>
        </div>


        @foreach($carGroupInfo as $car)
            <div class="row row-table">
                <div class="col-3">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">

                </div>
                <div class="col-2">

                </div>

                <div class="col-2">

                </div>
            </div>

        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Машины в группу не добавлены</h5>
            </div>
        </div>
    @endif



    <div class="row">
        <div class="col-4">
            <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить группу" href=""><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection
