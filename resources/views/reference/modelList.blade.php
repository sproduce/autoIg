@extends('../adminIndex')


@section('header')


            <h6>Модель</h6>




@endsection

@section('content')

    @if($models->count())
        @foreach ($brands as $brand)
            <div class="row row-table">
                <div class="col-10">
                   <a href="/reference/generation?modelId="> </a>
                </div>
                <div class="col-2">
                    <a class="btn btn-ssm btn-outline-warning" title="Редактировать" onclick="DialogUser('/dialog/edituser?user_id=1091',insertMask);"><i class="far fa-edit"></i></a>

                    <div class="float-right">

                          <a href="/cars/delCar?carId=1552" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить машину?')"><i class="fas fa-trash"></i> </a>
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


