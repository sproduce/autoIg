<form method="POST" action="/eventPhotocontrol" enctype="multipart/form-data">
    @csrf
    <input name="eventId" value="{{$eventObj->id}}" hidden/>
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
            <label for="datePhoto" title="Дата фотографии">Дата фотографии</label>
            <input type="date" name="datePhoto" id="datePhoto" class="form-control" value="{{$dateTime->toDateString()}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="timePhoto" title="Время">Время</label>
            <input type="time" name="timePhoto" id="timePhoto" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control"/>
        </div>
    </div>


    <div class="form-row text-center">
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Фотографии">Комментарий</label>
            <input type="text" name="comment" id="comment" class="form-control">
        </div>
    </div>


    <div class="form-row text-center">
        <div class="form-group col-md-4 input-group-sm">
            <label for="photo" title="Фотографии">Фотографии</label>
            <input type="file" accept="image/*"  multiple="true" name="photo[]" class="form-control-file" id="photo" required>
        </div>
    </div>


    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
