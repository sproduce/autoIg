    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Редактировать</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/rentEvent/edit">
    <input type="number" name="id" value="{{$rentEventObj->id}}" hidden/>
    @csrf
    <div class="row">
        <div class="col-4">Название</div>
        <div class="col-8"><input type="text" name="name" id="name" value="{{$rentEventObj->name}}" autocomplete="off"/></div>
    </div>
    <div class="row">
        <div class="col-4">Цвет</div>
        <div class="col-8"><input type="color" value="{{$rentEventObj->color}}" name="color" id="color"/></div>
    </div>
    <div class="row">
        <div class="col-4">Поведение</div>
        <div class="col-8"><input type="text" name="action" value="{{$rentEventObj->action}}" id="action" autocomplete="off"/></div>
    </div>
    <div class="row">
        <div class="col-4">Продолжительность</div>
        <div class="col-8"><input type="number" name="duration" value="{{$rentEventObj->duration}}" id="action" autocomplete="off"/></div>
    </div>
    <div class="row">
        <div class="col-4">Приоритет</div>
        <div class="col-8"><input type="number" name="priority" value="{{$rentEventObj->priority}}" id="priority" autocomplete="off"/></div>
    </div>
    <div class="row">
        <div class="col-4">К оплате</div>
        <div class="col-8"> <input type="checkbox" value="1" name="isToPay"
                                   @if($rentEventObj->isToPay)
                                        checked
                                   @endif/>
        </div>
    </div>
    <div class="row">
        <div class="col-4">Тип платежа</div>
        <div class="col-8">
            <select name="payOperationTypeId">
                @foreach($paymentTypes as $paymentType)
                    <option value="{{$paymentType->id}}" @if($rentEventObj->operationType->id==$paymentType->id)selected @endif>{{$paymentType->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>



