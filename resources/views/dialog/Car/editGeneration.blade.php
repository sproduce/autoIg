<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Редактировать поколение</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/reference/editGeneration">
    <input type="number" name="id" id="id" value="{{$generation->id}}" hidden/>
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="name" title="Латинские буквы">Поколение</label>
                <div class="col-sm-8">
                    <input list="oftenCars" type="text" name="name" id="name" class="form-control" autocomplete="off" value="{{$generation->name}}" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-6 col-form-label" for="start">Начало производства (год)</label>
                <div class="col-sm-4">
                    <input list="oftenCars" type="number" name="start" id="start" class="form-control" autocomplete="off" min="1990" max="2030" step="1" value="{{$generation->start}}" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-6 col-form-label" for="finish">Окончание производства (год)</label>
                <div class="col-sm-4">
                    <input list="oftenCars" type="number" name="finish" id="finish" class="form-control" value="{{$generation->finish}}" autocomplete="off"/>
                </div>
            </div>

        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
