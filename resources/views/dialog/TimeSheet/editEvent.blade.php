    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить событие</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="/timesheet/add">
    <div class="modal-body">
        @csrf
        <input name="carId" value="{{$carId}}" hidden/>
        <div class="row form-group">
            <div class="col-2 col-form-label">Дата</div>
            <div class="col-4"><input type="datetime-local" class="form-control form-control-sm" value="" name="dateTime"/></div>
            <div class="col-2 col-form-label">Событие</div>
            <div class="col-4">
                <select name="eventId" class="form-control form-control-sm">

                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-2 col-form-label">Сумма</div>
            <div class="col-4"><input type="number" class="form-control form-control-sm" name="sum"/></div>
            <div class="col-2 col-form-label">Пробег</div>
            <div class="col-4"><input type="number" class="col-6 form-control form-control-sm" name="mileage"/></div>
        </div>
        <div class="row form-group">
            <div class="col-2 col-form-label">Комментарий</div>
            <div class="col-10"><input type="text" class="col-12 form-control form-control-sm"  name="comment"/></div>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
    </form>




