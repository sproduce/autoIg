<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Редактировать</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="">
    @csrf
    <input type="text" id="id" name="brandId" value="{{$engine->id}}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name" title="Латинские буквы">Двигатель</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{$engine->name}}" required/>
                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
