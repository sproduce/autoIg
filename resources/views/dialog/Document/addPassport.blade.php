    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Паспорт</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/document/storePassport">
    <input type="text" name="linkUuid" value="{{$passportObj->linkUuid}}" hidden />
    <input type="text" name="id" value="{{$passportObj->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-5 input-group-sm">
                    <label for="number" title="Номер паспорта">Номер паспорта</label>
                    <input type="text" name="number" id="number" class="form-control" value="{{$passportObj->number}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-5 input-group-sm">
                    <label for="issuedBy" title="">Выдан</label>
                    <input type="text" name="issuedBy" id="issuedBy" class="form-control" value="{{$passportObj->issuedBy}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="dateIssued" title="">Дата выдачи</label>
                    <input type="date" name="dateIssued" id="dateIssued" class="form-control" value="{{$passportObj->dateIssued}}" required autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-row text-center">
                <div class="form-group col-md-5 input-group-sm">
                    <label for="birthplace" title="">Место рождения</label>
                    <input type="text" name="birthplace" id="birthplace" class="form-control" value="{{$passportObj->birthplace}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-5 input-group-sm">
                    <label for="placeResidence" title="">Прописка</label>
                    <input type="text" name="placeResidence" id="placeResidence" class="form-control" value="{{$passportObj->placeResidence}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="dateResidence" title="">Дата</label>
                    <input type="date" name="dateResidence" id="dateResidence" class="form-control" value="{{$passportObj->dateResidence}}" autocomplete="off"/>
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 