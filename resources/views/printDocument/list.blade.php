@extends('../adminIndex')


@section('header')
<a class="btn btn-ssm btn-outline-success mr-3 DialogUserMin" title="Добавить шаблон" href="/printDocument/add"><i class="far fa-plus-square"></i></a>
            <h5 class="m-0">Список Шаблонов</h5>
@endsection

            
            
@section('content')
   
            @forelse($printDocuments as $printDocument)
                <div class="row">
                    <div class="col-6">{{$printDocument->info}}</div>
                    <div class="col-2">{{$printDocument->nickname}}</div>
                    <div class="col-3">
                        @if(count($printDocument->fileLink->files))
                            <a href="/file/show/{{$printDocument->fileLink->files[0]->id}}" target="_blank">{{$printDocument->fileLink->files[0]->fileName}}</a>
                        @endif
                    </div>
                    <div class="col-1">
                        <a href="/printDocument/add/{{$printDocument->id}}" class="btn btn-ssm btn-outline-warning DialogUserMin" title="Редактировать"> <i class="far fa-edit"></i></a>
                        <a href="" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить шаблон?')"><i class="fas fa-trash"></i> </a>
                    </div>
                </div>
            
                @empty
                <div class="row">
                    <div class="col-12 text-center h5">Шаблоны не добавлены</div>
                </div>
            @endforelse
            
            
            
@endsection

            
            
            
@section('js')

@endsection

