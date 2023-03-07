    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Платежные реквизиты</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/document/storePayment">
    <input type="text" name="linkUuid" value="{{$paymentObj->linkUuid}}" hidden />
    <input type="text" name="id" value="{{$paymentObj->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="checkingAccount" title="расчетный счет">Расчетный счет</label>
                    <input type="text" name="checkingAccount" id="checkingAccount" class="form-control" value="{{$paymentObj->checkingAccount}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="bankName" title="">Банк</label>
                    <input type="text" name="bankName" id="bankName" class="form-control" value="{{$paymentObj->bankName}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="bankInn" title="">ИНН банка</label>
                    <input type="text" name="bankInn" id="bankInn" class="form-control" value="{{$paymentObj->bankInn}}" required autocomplete="off"/>
                </div>
            </div>
            
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for=bankBik" title="БИК банка">БИК банка</label>
                    <input type="text" name="bankBik" id="bankBik" class="form-control" value="{{$paymentObj->bankBik}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="correspondentAccount" title="к/сч">к/сч</label>
                    <input type="text" name="correspondentAccount" id="correspondentAccount" class="form-control" value="{{$paymentObj->correspondentAccount}}" required autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="address" title="">Юридический адрес</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{$paymentObj->address}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-6 input-group-sm">
                    <label for="name" title="Название филиала">Название филиала</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{$paymentObj->name}}" autocomplete="off"/>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
 