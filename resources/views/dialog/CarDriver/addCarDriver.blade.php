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
            <div class="form-group row ">
                <label for="surname" class="col-sm-2 col-form-label form-control-sm">Фамилия</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="surname" name="surname" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label form-control-sm">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="name" name="name" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label for="patronymic" class="col-sm-2 col-form-label form-control-sm">Отчество</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="patronymic" name="patronymic" autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                 <legend class="col-form-label col-sm-2 form-control-sm">Пол</legend>
                 <div class="col-sm-3 pr-0">
                     <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                         <input class="form-check-input" type="radio" name="male" id="male1" value="1" checked>
                         <label class="form-check-label" for="male1">М</label>

                     </div>
                     <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                         <input class="form-check-input" type="radio" name="male" id="male2" value="0">
                            <label class="form-check-label" for="male2">Ж</label>

                     </div>
                 </div>
                <label for="birthday" class="col-form-label form-control-sm">Дата рождения</label>
                <div class="col-sm-4 pr-0">

                     <input type="date" class="form-control form-control-sm" id="birthday" name="birthday">
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label form-control-sm">Телефон</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm  phone" id="phone" name="phone[]" autocomplete="off">
                </div>
                <div class="col-1 pl-0">
                        <i class="fas fa-plus text-success" onclick="plusPhone();"></i>
                </div>
            </div>


            <div class="form-group row" id="beforeNickName">
                <label for="nickname" class="col-sm-2 col-form-label form-control-sm">NickName</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="nickname" name="nickname" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="comment" class="col-sm-2 col-form-label form-control-sm">Комментарий</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control-sm" id="comment" name="comment" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <label for="regionId" class="col-sm-2 col-form-label form-control-sm">Регион</label>
                <div class="col-sm-8">
                    <select name="regionId" id="regionId" class="form-control form-control-sm">
                        @foreach($carDriverRegions as $carDriverRegion)
                            <option value="{{$carDriverRegion->id}}">{{$carDriverRegion->name}}</option>
                            @endforeach
                    </select>
                </div>
            </div>

        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
</form>

<script>
    function plusPhone(){
        $( "<div class=\"form-group row\"><label for=\"phone\" class=\"col-sm-2 col-form-label form-control-sm\">Телефон</label><div class=\"col-sm-4\"><input type=\"text\" class=\"form-control form-control-sm  phone\" name=\"phone[]\" autocomplete=\"off\"> </div>" ).insertBefore( "#beforeNickName" );
        $('.phone').inputmask("+7(999) 999-99-99");
    }

</script>
