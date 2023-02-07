    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Полное официальное название</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/document/storeEntity">
    <input type="text" name="linkUuid" value="{{$entityObj->linkUuid}}" hidden />
    <input type="text" name="id" value="{{$entityObj->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="fullName" title="расчетный счет">Полное официальное название</label>
                    <input type="text" name="fullName" id="fullName" class="form-control" value="{{$entityObj->fullName}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="shortName" title="">Сокращенное наименование</label>
                    <input type="text" name="shortName" id="shortName" class="form-control" value="{{$entityObj->shortName}}" required autocomplete="off"/>
                </div>
            </div>
            
           
             <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="englishName" title="">Полное наименование на английском языке</label>
                    <input type="text" name="englishName" id="englishName" class="form-control" value="{{$entityObj->englishName}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="nameReg" title="">Наименование регистрирующего органа</label>
                    <input type="text" name="nameReg" id="nameReg" class="form-control" value="{{$entityObj->nameReg}}" autocomplete="off"/>
                </div>
            </div>
            
            
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="address" title="">Юридический адрес</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$entityObj->address}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="mailingAddress" title="">Местонахождение</label>
                    <input type="text" name="mailingAddress" id="mailingAddress" class="form-control" value="{{$entityObj->mailingAddress}}" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="phone" title="">Телефон</label>
                    <input type="text" name="phone" id="phone" class="form-control" value="{{$entityObj->phone}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="ogrn" title="">ОГРН/ОГРНИП</label>
                    <input type="text" name="ogrn" id="ogrn" class="form-control" value="{{$entityObj->ogrn}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="oktmo" title="">ОКТМО</label>
                    <input type="text" name="oktmo" id="oktmo" class="form-control" value="{{$entityObj->oktmo}}" autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="dateReg" title="">Дата государственной регистрации</label>
                    <input type="date" name="dateReg" id="dateReg" class="form-control" value="{{$entityObj->dateReg}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okved" title="">ОКВЭД</label>
                    <input type="text" name="okved" id="okved" class="form-control" value="{{$entityObj->okved}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okpo" title="">ОКПО</label>
                    <input type="text" name="okpo" id="okpo" class="form-control" value="{{$entityObj->okpo}}" autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okato" title="">ОКАТО</label>
                    <input type="text" name="okato" id="okato" class="form-control" value="{{$entityObj->okato}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="okogu" title="">ОКОГУ</label>
                    <input type="text" name="okogu" id="okogu" class="form-control" value="{{$entityObj->okogu}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="inn" title="">ИНН</label>
                    <input type="text" name="inn" id="inn" class="form-control" value="{{$entityObj->inn}}" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="kpp" title="">КПП</label>
                    <input type="text" name="kpp" id="kpp" class="form-control" value="{{$entityObj->kpp}}" autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="director" title="расчетный счет">Генеральный директор</label>
                    <input type="text" name="director" id="director" class="form-control" value="{{$entityObj->director}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="accountant" title="">Главный бухгалтер</label>
                    <input type="text" name="accountant" id="accountant" class="form-control" value="{{$entityObj->accountant}}" autocomplete="off"/>
                </div>
            </div>
            
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 