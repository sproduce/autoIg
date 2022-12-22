<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Файлы</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="container-fluid">
        @forelse($filesObj as $file)
            <div class="row">
                <div class="col-4">
                    <a href="/file/show/{{$file->id}}" target="_blank">
                        {{$file->fileName}}
                    </a>
                </div>
                <div class="col-6"></div>
                <div class="col-1"><a href="/file/download/{{$file->id}}" title="Сохранить" class="btn btn-ssm btn-outline-success"><i class="fas fa-download"></i></a></div>
                <div class="col-1">
                    <a href="/file/deleteFile/{{$file->uuid}}/{{$file->id}}" class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить" onclick="return confirm('Удалить файл?')"><i class="fas fa-trash"></i> </a>
                </div>
            </div>
        @empty
            У события нет файлов
        @endforelse
            <form action="/file/addFiles/{{$uuid}}" method="POST" enctype="multipart/form-data">
                @csrf
        <div class="form-row text-center p-2 mt-4 border-top">
            <div class="form-group col-md-4 input-group-sm">
                <label for="file" title="Файлы">Добавить файлы</label>
                <input type="file" multiple="true" name="file[]" class="form-control-file" id="file">
            </div>
        </div>
                <input type="submit"/>
                </form>
    </div>
</div>

