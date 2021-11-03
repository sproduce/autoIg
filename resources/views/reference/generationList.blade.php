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
                    {{$generation->name}}
                </div>
                <div class="col-2">
                    <a href="/reference/editGeneration" class="btn btn-ssm btn-outline-warning DialogUserMin" title="Редактировать"><i class="far fa-edit"></i></a>
                    <div class="float-right">
                          <a href="/repository/delGeneration?generationId={{$generation->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить поколение?')"><i class="fas fa-trash"></i> </a>
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
            <a class="btn btn-ssm btn-outline-success DialogUserMin" title="Добавить поколение" href="/dialog/addGeneration?modelId={{$model->id}}"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection


