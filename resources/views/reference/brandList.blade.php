@extends('../adminIndex')


@section('header')


            <h6>Марки машин</h6>




@endsection

@section('content')
    @if($brands->count())
        есть данные
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Производители не добавлены</h5>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-12 text-center mt-4" >
            @foreach (range('A','Z') as $letter)
                <a href="/reference/brand?letter={{ $letter }}">{{ $letter }}</a>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить производителя" href="/dialog/addBrand"><i class="far fa-plus-square"></i></a>
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить список производителей" href="/dialog/addBrandGroup"><i class="fas fa-folder-plus"></i></a>
        </div>
    </div>




@endsection


