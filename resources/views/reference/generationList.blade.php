@extends('../adminIndex')


@section('header')


            <h6>Поколения</h6>




@endsection

@section('content')
{{$model->brand->name}} {{$model->name}}

    @if($model->generations->count())
        @foreach ($model->generations as $generation)
            <div class="row row-table">
                <div class="col-10">
                   <a href="/reference/model?brandId={{$brand->id}}"> {{$brand->name}}</a>
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
                <h5>Поколения не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить поколение" href="/dialog/addGeneration?modelId={{$model->id}}"><i class="far fa-plus-square"></i></a>
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить список поколений" href="/dialog/addGenerationGroup?modelId={{$model->id}}"><i class="fas fa-folder-plus"></i></a>
        </div>
    </div>




@endsection


