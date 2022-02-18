<form method="POST" action="/eventCrash">
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            @if ($carObj->id)
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" disabled />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden/>
            @else
                <input id="carText" class="form-control" value="" disabled />
                <input id="carId" name="carId" class="form-control" value="" hidden/>
            @endif
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор">
                Договор
                <a href="/payment/addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            @if ($contractObj->id)
                <input id="contractText" name="contractText"  class="form-control" value="{{$contractObj->number}}" disabled />
                <input name="contractId" id="contractId" value="{{$contractObj->id}}"  hidden/>
            @else
                <input id="contractText" name="contractText"  class="form-control" disabled />
                <input name="contractId" id="contractId" value=""  hidden/>
            @endif
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateCrash" title="Дата ДТП">Дата ДТП</label>
            <input type="date" name="dateCrash" id="dateCrash" class="form-control" step="any" value="{{$dateTime->format('Y-m-d')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timeCrash" title="Время ДТП">Время ДТП</label>
            <input type="time" step="60" name="timeCrash" id="timeCrash" class="form-control" step="any" value="{{$dateTime->format('H:i')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="culprit" title="Виновник ДТП">Виновник ДТП</label>
            <select name="culprit" id="culprit"  class="form-control" >
                <option value="1">Водитель</option>
                <option value="0">3-я сторона</option>
            </select>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="sum" title="Сумма убытка">Сумма убытка</label>
            <input type="number" name="sum" id="sum" class="form-control"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" class="form-control"/>
        </div>
    </div>



    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
