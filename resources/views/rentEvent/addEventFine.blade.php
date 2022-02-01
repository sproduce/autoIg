<form method="POST" action="/eventFine">
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
            <label for="dateOrder" title="Дата постановления">Дата постановления</label>
            <input type="date" name="dateOrder" id="dateOrder" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="dateTimeFine" title="Дата нарушения">Дата нарушения</label>
            <input type="datetime-local" name="dateTimeFine" id="dateTimeFine" class="form-control" value="{{$dateTime->toDateTimeLocalString()}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="uin" title="УИН номер">УИН номер</label>
            <input type="text" name="uin" id="uin" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePaySale" title="Срок оплаты со скидкой">Срок оплаты со скидкой</label>
            <input type="date" name="datePaySale" id="datePaySale" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="datePayMax" title="Максимальный срок оплаты">Максимальный срок оплаты</label>
            <input type="date" name="datePayMax" id="datePayMax" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="sumSale" title="Сумма штрафа со скидкой">Сумма штрафа со скидкой</label>
            <input type="number" name="sumSale" id="sumSale" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="sum" title="Сумма штрафа">Сумма штрафа</label>
            <input type="number" name="sum" id="sum" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>