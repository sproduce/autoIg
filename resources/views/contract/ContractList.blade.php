@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Договора</h6>
@endsection

@section('content')

    @if($contracts->count())

    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Договора не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUser" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection


