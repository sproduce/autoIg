@extends('../adminIndex')


@section('header')


            <h6>Марки машин</h6>




@endsection

@section('content')

    @if($brands->count())
        @foreach ($brands as $brand)
            <div class="row row-table">
                <div class="col-10">
                   <a href="/reference/model?brandId={{$brand->id}}"> {{$brand->name}}</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-ssm btn-outline-warning DialogUserSMin" title="Редактировать" href="/dialog/editBrand?brandId={{$brand->id}}"><i class="far fa-edit"></i></a>

                    <div class="float-right">

                          <a href="/reference/delBrand?brandId={{$brand->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить марку?')"><i class="fas fa-trash"></i> </a>
                    </div>



                </div>
            </div>


        @endforeach


    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Марки не добавлены</h5>
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


