    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить событие</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/rentEvent/add">
    @csrf
    <div class="row">
        <div class="col-4">Название</div>
        <div class="col-8"><input type="text" name="name" id="name" autocomplete="off"/></div>
    </div>
    <div class="row">
        <div class="col-4">Цвет</div>
        <div class="col-8"><input type="color" name="color" id="color"/></div>
    </div>
    <div class="row">
        <div class="col-4">Поведение</div>
        <div class="col-8"><input type="text" name="action" id="action" autocomplete="off"/></div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
</form>



