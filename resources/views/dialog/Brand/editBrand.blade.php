<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Редактировать марку</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/reference/editBrand">
    @csrf
    <input type="text" id="brandId" name="brandId" value="{{$brand->id}}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="brandName" title="Латинские буквы">Марка</label>
                <div class="col-sm-8">
                    <input list="oftenCars" type="text" name="brandName" id="brandName" class="form-control" autocomplete="off" value="{{$brand->name}}" required/>
                </div>

            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
