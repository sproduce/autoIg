

<form method="POST" action="/rentEvent/{{$eventObj->id}}">
    <input type="number" name="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
    <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
<!--                <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>-->
            <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly required />
            <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор"> Договор </label>
<!--            <a href="/contract/addContractTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>-->
            <input id="contractText" name="contractText" value="{{old('contractText',$eventDataObj->contractNumber ?? $contractObj->number)}}" class="form-control" disabled required/>
            <input name="contractId" id="contractId" value="{{old('contractId',$eventDataObj->contractId ?? $contractObj->id)}}" hidden/>
        </div>


        <div class="form-group col-md-2 input-group-sm">
            <label for="duration" title="Продолжительность">Продолжительность</label>
            <input type="number" name="duration" id="duration" class="form-control" value="{{old('duration',$eventDataObj->duration ?? $eventObj->duration)}}"/>
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateStart" title="Начало аренды">Дата начала аренды</label>
            <input type="date" name="dateStart" id="dateStart" class="form-control" value="{{old('dateStart',$eventDataObj->dateTime ? $eventDataObj->dateTime->toDateString() : $dateTime->toDateString())}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeStart" title="Начало аренды">Время начала аренды</label>
            <input type="time" step="60" name="timeStart" id="timeStart" class="form-control" value="{{old('timeStart',$eventDataObj->dateTime ? $eventDataObj->dateTime->format('H:i') : $dateTime->format('H:i'))}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="sum" title="Стоимость">Стоимость</label>
            <input type="number" name="sum[]" id="sum" class="form-control" value="{{$eventDataObj->sum}}" required/>
        </div>
    </div>



    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            @if ($eventDataObj->id)
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
            @else
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
            @endif
        </div>
    </div>
</form>

