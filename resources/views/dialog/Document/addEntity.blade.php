    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Полное официальное название</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/document/storeEntity">
    <input type="text" name="linkUuid" value="{{$entityObj->uuid}}" hidden />
    <input type="text" name="id" value="{{$entityObj->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="fullName" title="расчетный счет">Полное официальное название</label>
                    <input type="text" name="fullName" id="fullName" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="shortName" title="">Сокращенное наименование</label>
                    <input type="text" name="shortName" id="shortName" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            
           
             <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="englishName" title="">Полное наименование на английском языке</label>
                    <input type="text" name="englishName" id="englishName" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="nameReg" title="">Наименование регистрирующего органа</label>
                    <input type="text" name="nameReg" id="nameReg" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            
            
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="address" title="">Юридический адрес</label>
                    <input type="text" name="address" id="address" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="mailingAddress" title="">Местонахождение</label>
                    <input type="text" name="mailingAddresse" id="mailingAddress" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="phone" title="">Телефон</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="ogrn" title="">ОГРН</label>
                    <input type="text" name="ogrn" id="ogrn" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="ogrnip" title="">ОГРНИП</label>
                    <input type="text" name="ogrnip" id="ogrnip" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="dateReg" title="">Дата государственной регистрации</label>
                    <input type="text" name="dateReg" id="dateReg" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okved" title="">ОКВЭД</label>
                    <input type="text" name="okved" id="okved" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okpo" title="">ОКПО</label>
                    <input type="text" name="okpo" id="okpo" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okato" title="">ОКАТО/ОКТМО</label>
                    <input type="text" name="okato" id="okato" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okogu" title="">ОКОГУ</label>
                    <input type="text" name="okogu" id="okogu" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="inn" title="">ИНН/КПП</label>
                    <input type="text" name="inn" id="inn" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="directort" title="расчетный счет">Генеральный директор</label>
                    <input type="text" name="directort" id="directort" class="form-control" value="" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="accountant" title="">Главный бухгалтер</label>
                    <input type="text" name="accountant" id="accountant" class="form-control" value="" required autocomplete="off"/>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 