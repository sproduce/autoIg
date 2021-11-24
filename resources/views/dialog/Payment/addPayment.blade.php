<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить платеж</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/payment/add">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row ">
                <label for="surname" class="col-sm-2 col-form-label form-control-sm">Дата</label>
                <div class="col-sm-2">
                    <input type="text" class="form-control form-control-sm" id="surname" name="surname" autocomplete="off" required/>
                </div>
            </div>


        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
        <input type="submit" class="btn btn-primary" value="Добавить следующий">
    </div>
</form>


