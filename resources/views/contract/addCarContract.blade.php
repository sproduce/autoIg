@extends('../adminIndex')


@section('header')
    <h6 class="m-0">Добавить договор</h6>
@endsection
@section('content')
<form method="POST" action="/contract/add">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" value="{{date('Y-m-d')}}T{{date('h:i')}}"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        <option>Тип договора</option>
                    </select>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-5 input-group-sm">
                    <label for="driverId" title="Водитель">Водитель</label>
                    <a href="" class="btn btn-ssm btn-outline-success ml-2"><i class="fas fa-search-plus"></i></a>
                    <input id="carText" class="form-control" disabled/>
                    <input name="driverId" id="driverId"  hidden />
                </div>
                <div class="form-group col-md-5 input-group-sm">
                    <label for="carId" title="Машина">Машина</label>
                    <a href="" class="btn btn-ssm btn-outline-success ml-2"><i class="fas fa-search-plus"></i></a>
                    <input id="carText" class="form-control" disabled/>
                    <input name="carId" id="carId"  hidden />
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>
                    <select name="statusId" id="statusId" class="form-control">
                        <option>Статус</option>
                    </select>
                </div>


            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="tarifId" title="Тариф договора">Тариф договора</label>
                    <select name="tarifId" id="tarifId" class="form-control">
                        <option>тариф</option>
                    </select>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="balance" title="Баланс договора">Баланс договора</label>
                    <input type="text" name="balance" id="balance" class="form-control"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="deposit" title="Депозит договора">Депозит договора</label>
                    <input type="text" name="deposit" id="deposit" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" autocomplete="off"/>
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



@endsection
