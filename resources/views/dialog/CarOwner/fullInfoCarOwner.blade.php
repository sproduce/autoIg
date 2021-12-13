<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о владельце</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-3"><strong>Имя</strong></div>
        <div class="col-3">{{$carOwner->name}}</div>
        <div class="col-3"><strong>NickName</strong></div>
        <div class="col-3">{{$carOwner->nickName}}</div>
    </div>
    <div class="row">
        <div class="col-3"><strong>Комменатрий</strong></div>
        <div class="col-9">{{$carOwner->start}}</div>
    </div>


<div class="modal-footer d-flex justify-content-center">




</div>

</div>
