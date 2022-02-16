    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Редактировать</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="/timesheet/edit">
    <div class="modal-body">
        @csrf
        <input name="timeSheetId" value="{{$timeSheet->id}}" hidden/>
        <div class="row form-group">
            <div class="col-2 col-form-label">Дата</div>
            <div class="col-4">
                <input type="date" class="form-control form-control-sm" value="{{$timeSheet->dateTime->format('Y-m-d')}}" name="date"/>
            </div>
            <div class="col-2 col-form-label">Время</div>
            <div class="col-4">
                <input type="time" class="form-control form-control-sm" value="{{$timeSheet->dateTime->format('H:i')}}" name="time"/>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-2 col-form-label">Сумма</div>
            <div class="col-4">
                <input type="number" class="form-control form-control-sm" name="sum" value="{{$timeSheet->sum}}"/>
            </div>
            <div class="col-2 col-form-label">Пробег</div>
            <div class="col-4">
                <input type="number" class="col-6 form-control form-control-sm" name="mileage" value="{{$timeSheet->mileage}}"/>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-3 col-form-label">Продолжительность</div>
            <div class="col-3">
                <input type="number" class="form-control form-control-sm"  value="{{$timeSheet->duration}}" name="duration"/>
            </div>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
    </form>




