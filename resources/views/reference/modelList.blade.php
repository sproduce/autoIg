@extends('../adminIndex')


@section('header')
      <h6>Модель</h6>
@endsection

@section('content')
    {{$brand->name}}
    @if($brand->models->count())
        @foreach ($brand->models as $model)
            <div class="row row-table">
                <div class="col-10">
                   <a href="/reference/generation?modelId={{$model->id}}"> {{$model->name}}</a>
                </div>
                <div class="col-2">
                    <a class="btn btn-ssm btn-outline-warning DialogUserSMin" title="Редактировать" href="/dialog/editmodel?modelId={{$model->id}}" ><i class="far fa-edit"></i></a>
                    <div class="float-right">
                          <a href="/reference/delModel?modelId={{$model->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить модель?')"><i class="fas fa-trash"></i> </a>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Модели не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить модель" href="/dialog/addModel?brandId={{$brand->id}}"><i class="far fa-plus-square"></i></a>
            <a class="btn btn-ssm btn-outline-success DialogUserSMin" title="Добавить список моделей" href="/dialog/addModelGroup?brandId={{$brand->id}}"><i class="fas fa-folder-plus"></i></a>
        </div>
    </div>




@endsection


