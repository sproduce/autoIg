<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Редактировать nickName</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>


<form method="post" action="/motorPool/editNickname">
    @csrf
<div class="modal-body">
    <div class="container-fluid">
        <input name="id" type="text" value="{{$car->id}}" hidden/>
        <input name="nickname" type="text" value="{{$car->nickName}}"/>
    </div>
</div>

<div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-sm btn-primary" value="Сохранить">
    </div>
</form>