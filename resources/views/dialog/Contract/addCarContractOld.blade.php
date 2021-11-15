    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить договор для автомобиля {{$car->generation->model->brand->name}} {{$car->generation->model->name}} {{$car->nickName}}</h6>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/contract/add">
    @csrf
    <input type="text" name="carId" value="{{$car->id}}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" class="form-control"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" class="form-control"/>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        <option>Тип договора</option>
                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="carDriverId" title="Водитель">Водитель</label>
                    <select name="carDriverId" id="carDriverId" class="form-control">
                        <option>Водитель</option>
                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" autocomplete="off"/>
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="balance" title="Баланс договора">Баланс договора</label>
                    <input type="text" name="balance" id="balance" class="form-control"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>
                    <select name="statusId" id="statusId" class="form-control">
                        <option>Статус</option>
                    </select>
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment" title="Комментарий">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control"/>
                </div>

            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            <input type="submit" class="btn btn-primary" value="Добавить">
        </div>
    </div>
</form>



