<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о группе машин</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Название</strong></div>
        <div class="col-3">{{$carGroup->name}}</div>
        <div class="col-3"><strong>NickName</strong></div>
        <div class="col-3">{{$carGroup->nickName}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Открыта</strong></div>
        <div class="col-3">{{$carGroup->start}}</div>
        <div class="col-3"><strong>Закрыта</strong></div>
        <div class="col-3">{{$carGroup->finish}}</div>
    </div>


<div class="modal-footer d-flex justify-content-center">




</div>

</div>
