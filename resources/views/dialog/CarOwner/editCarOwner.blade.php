<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Редактировать владельца</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/carOwner/edit">
    @csrf
    <input type="text" name="carOwnerId" value="{{$carOwner->id}}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Имя</label>
                <div class="col-sm-8">
                    <input type="text" name="name" id="name" value="{{$carOwner->name}}" class="form-control form-control-sm" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="nickName">Nickname</label>
                <div class="col-sm-8">
                    <input type="text" name="nickName" id="nickName" value="{{$carOwner->nickName}}" class="form-control form-control-sm" autocomplete="off"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="comment">Комментарий</label>
                <div class="col-sm-8">
                    <input type="text" name="comment" id="comment" value="{{$carOwner->comment}}" class="form-control form-control-sm" autocomplete="off"/>
                </div>
            </div>
        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
