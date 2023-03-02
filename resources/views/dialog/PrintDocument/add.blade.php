    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Шаблон</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/printDocument/add" enctype="multipart/form-data">
    <input type="text" name="id" value="{{$printDocument->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="info" title="">Название шаблона</label>
                    <input type="text" name="info" id="info" class="form-control" value="{{$printDocument->info}}" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="nickname" title="">Название файла при сохранении</label>
                    <input type="text" name="nickname" id="nickname" class="form-control" value="{{$printDocument->nickname}}" required autocomplete="off"/>
                </div>
            </div>
             <div class="form-row text-center">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="file" title="">Файл</label>
                    <input type="file" name="file" id="file" class="form-control" value="" accept=".docx" required autocomplete="off"/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 