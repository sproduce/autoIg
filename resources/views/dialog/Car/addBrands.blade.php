<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить марки списком</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/reference/brands">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="brandsName" title="Латинские буквы">Марка</label>
                    <textarea id="brandsName" name="brandsName">   </textarea>
                </div>
            </div>

        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
