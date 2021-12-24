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
        <div class="row">
            <div class="col-3">Дата</div>
            <div class="col-9"><input type="datetime-local" value="{{$dateTime}}" name="dateTime"/></div>
        </div>
        <div class="row">
            <div class="col-3">Событие</div>
            <div class="col-9">
                <select name="eventId">
                    @foreach($rentEvents as $rentEvent)
                        <option value="{{$rentEvent->id}}">{{$rentEvent->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-3">Сумма</div>
            <div class="col-3"><input type="number" name="sum"/></div>
        </div>
        <div class="row">
            <div class="col-3">Комментарий</div>
            <div class="col-9"><input type="text"  name="comment"/></div>
        </div>
    </div>
    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
    </form>




