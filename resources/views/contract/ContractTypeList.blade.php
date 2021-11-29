@extends('../adminIndex')


@section('header')
    <h6 class="m-0">Типы договоров</h6>
@endsection

@section('content')

    @if($contractTypes->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-2">Тип договора</div>
        </div>
        @foreach($contractTypes as $contractType)
            <div class="row row-table">
                <div class="col-2">{{$contractType->name}}</div>
            </div>

        @endforeach


    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Типы договоров не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success" title="Добавить новый тип договора" href="/contract/ContractTypes"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection

