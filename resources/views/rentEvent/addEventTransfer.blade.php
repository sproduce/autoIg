<form method="POST" action="/eventTransfer">
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
            <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            @if($carObj->id)
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
            <input id="contractText" name="contractText"  class="form-control" disabled />
            <input name="contractId" id="contractId" value=""  hidden/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateTransfer" title="Дата приема/передачи">Дата приема/передачи</label>
            <input type="date" name="dateTransfer" id="dateTransfer" class="form-control" step="any" value="{{$dateTime->format('Y-m-d')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timeTransfer" title="Время приема/передачи">Время приема/передачи</label>
            <input type="time" step="60" name="timeTransfer" id="timeTransfer" class="form-control" step="any" value="{{$dateTime->format('H:i')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="typeTransfer" title="Тип операции">Тип операции</label>
            <select name="typeTransfer" id="typeTransfer"  class="form-control" >
                <option value="0">Передача</option>
                <option value="1">Прием</option>
            </select>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
