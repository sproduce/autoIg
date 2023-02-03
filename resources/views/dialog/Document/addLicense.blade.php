    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Водительское удостоверение</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/document/storeLicense">
    <input type="text" name="linkUuid" value="{{$licenseObj->linkUuid}}" hidden />
    <input type="text" name="id" value="{{$licenseObj->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="number" title="Номер паспорта">Номер документа</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{$licenseObj->number}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="city" title="">Город выдачи</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{$licenseObj->city}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="issuedBy" title="">Кем выдан</label>
                    <input type="text" name="issuedBy" id="issuedBy" class="form-control" value="{{$licenseObj->issuedBy}}" required autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="">Дата начала</label>
                    <input type="date" name="start" id="start" class="form-control" value="{{$licenseObj->start}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="">Дата окончания</label>
                    <input type="date" name="finish" id="finish" class="form-control" value="{{$licenseObj->finish}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="categories" title="">Категории</label>
                    <input type="text" name="categories" id="categories" class="form-control" value="{{$licenseObj->categories}}" required autocomplete="off"/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 