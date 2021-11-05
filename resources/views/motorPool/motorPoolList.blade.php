@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Машины </h6>
    <input type="text" class="h-50 ml-3" name="queryText" id="queryText" title="быстрый поиск"/>
@endsection

@section('content')

    @if(!1)
        @foreach ($carsPool as $car)
            <div class="row row-table">
                <div class="col-10">

                </div>
                <div class="col-2">

                </div>
            </div>


        @endforeach


    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Машины в автопарк не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUser" title="Добавить машину" href="/motorPool/add"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection


