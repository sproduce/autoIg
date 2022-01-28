<form method="POST" action="/eventTransfer">
    @csrf
    <input name="eventId" value="{{$eventObj->id}}" hidden/>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">
                Машина
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" disabled />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden />
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
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateTimeTransfer" title="Дата приема/передачи">Дата время приема/передачи</label>
            <input type="datetime-local" name="dateTimeTransfer" id="dateTimeTransfer" class="form-control" step="any" value="{{$dateTime->toDateTimeLocalString()}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="typeTransfer" title="Тип операции">Тип операции</label>
            <select name="typeTransfer" id="typeTransfer"  class="form-control" >
                <option value="0">Передача</option>
                <option value="1">Прием</option>
            </select>
        </div>
    </div>


    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
