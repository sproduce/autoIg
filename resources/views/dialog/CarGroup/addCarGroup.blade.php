<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить группу</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/carGroup/add">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Название</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="name" class="form-control form-control-sm" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="nickName">Nickname</label>
                <div class="col-sm-8">
                    <input type="text" name="nickName" id="nickName" class="form-control form-control-sm" autocomplete="off"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="start">Открыта</label>
                <div class="col-sm-6">
                    <input type="date" name="start" id="start" class="form-control form-control-sm" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="finish">Закрыта</label>
                <div class="col-sm-6">
                    <input type="date" name="finish" id="finish" class="form-control form-control-sm" autocomplete="off"/>
                </div>
            </div>


        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
