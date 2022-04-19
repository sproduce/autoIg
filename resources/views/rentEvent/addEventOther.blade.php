<form method="POST" action="/eventOther">
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

    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="otherSum" title="Сумма">Сумма</label>
            <input type="number" name="otherSum" id="otherSum" class="form-control"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateFine" title="Дата нарушения">Дата события</label>
            <input type="date" name="dateFine" id="dateFine" class="form-control" value="{{$dateTime->toDateString()}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timeFine" title="Время нарушения">Время события</label>
            <input type="time" name="timeFine" id="timeFine" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="otherComment" title="Комментарий">Комментарий</label>
            <input type="text" name="otherComment" id="otherComment" class="form-control"/>
        </div>
    </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
