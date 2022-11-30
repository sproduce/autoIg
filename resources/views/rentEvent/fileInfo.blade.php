 @if($filesObj->count())
    <div class="row border-top mt-3">
        <div class="col-12 text-center"><strong>Файлы</strong></div>
    </div>
    @foreach($filesObj as $file)
        <div class="row">
            <div class="col-4">
                <a href="/file/show/{{$file->id}}" target="_blank">
                    {{$file->fileName}}
                </a>
            </div>
            <div class="col-6"></div>
            <div class="col-1"><a href="/file/download/{{$file->id}}" title="Сохранить" class="btn btn-ssm btn-outline-success"><i class="fas fa-download"></i></a></div>
        </div>
    @endforeach
@endif