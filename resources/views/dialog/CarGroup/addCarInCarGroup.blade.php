<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить машину в группу</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="">
    <input type="number" name="carId" value="{{$carObj->id}}" hidden/>
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name">Группа</label>
                <div class="col-sm-8">
                    <select name="groupId">
                        @foreach($carGroups as $group)
                        <option value="{{$group->id}}">{{$group->nickName}}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="start">Добавлена</label>
                <div class="col-sm-6">
                    <input type="date" name="start" id="start" class="form-control form-control-sm" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="finish">Удалена</label>
                <div class="col-sm-6">
                    <input type="date" name="finish" id="finish" class="form-control form-control-sm" autocomplete="off"/>
                </div>
            </div>
        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
