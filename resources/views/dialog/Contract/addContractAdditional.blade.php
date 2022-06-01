    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить услугу</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form method="POST" action="/contract/addAdditional">
        <input name="contractId" value="{{$contractId}}" hidden/>
        @csrf

        <div class="modal-body">
            <div class="form-group row">
                <label for="sum" class="col-sm-2 col-form-label form-control-sm">Сумма</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control form-control-sm" id="sum" name="sum" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label form-control-sm">Комментарий</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="comment" name="comment" autocomplete="off" required/>
                </div>
            </div>
            </div>
        </div>




        <div class="modal-footer d-flex justify-content-center">
            <div class="form-row text-center">
                <div class="input-group col-1">
                    <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
                </div>
            </div>
        </div>

    </form>
