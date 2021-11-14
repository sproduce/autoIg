<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить водителя</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/carDriver/add">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label for="surname" class="col-sm-2 col-form-label pl-0">Фамилия</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="surname" name="surname" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label pl-0">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                 <legend class="col-form-label col-sm-2 pt-0 pl-0">Пол</legend>
                 <div class="col-sm-2">
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="male" id="male1" value="1" checked>
                         <label class="form-check-label" for="male1">М</label>
                     </div>
                     <div class="form-check">
                         <input class="form-check-input" type="radio" name="male" id="male2" value="0">
                         <label class="form-check-label" for="male2">Ж</label>
                     </div>
                 </div>
                <label for="birthday" class="col-sm-4 col-form-label m-0">День рождения</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control pl-0 pr-0" id="birthday" name="birthday">
                </div>

            </div>
            <div class="form-group row">
                <label for="nickname" class="col-sm-2 col-form-label pl-0">NickName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nickname" name="nickname" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label pl-0">Комментарий</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="comment" name="comment" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label pl-0">Телефон</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="phone" name="phone" autocomplete="off">
                </div>
            </div>
        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
</form>


