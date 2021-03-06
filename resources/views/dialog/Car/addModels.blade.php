<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить список моделей</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/reference/models">
    <input type="text" id="brandId" name="brandId" value="{{$brand->id}}" hidden/>
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="modelsName" title="Латинские буквы">Список моделей</label>
                <div class="col-sm-6">
                    <textarea name="modelsName" id="modelsName" class="form-control" required></textarea>
                </div>
            </div>


        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
