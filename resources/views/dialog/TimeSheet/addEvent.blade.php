    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить событие</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/motorPool/add">
    @csrf


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
    </form>



