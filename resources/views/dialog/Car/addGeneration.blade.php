<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Добавить поколение</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<form method="POST" action="/reference/generation">
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="generationName" title="Латинские буквы">Поколение</label>
                <div class="col-sm-8">
                    <input list="oftenCars" type="text" name="generationName" id="generationName" class="form-control" autocomplete="off" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-6 col-form-label" for="generationStart">Начало производства (год)</label>
                <div class="col-sm-4">
                    <input list="oftenCars" type="number" name="generationStart" id="generationStart" class="form-control" autocomplete="off" min="1990" max="2030" step="1" required/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-6 col-form-label" for="generationFinish">Окончание производства (год)</label>
                <div class="col-sm-4">
                    <input list="oftenCars" type="number" name="generationFinish" id="generationFinish" class="form-control" autocomplete="off"/>
                </div>
            </div>

        </div>
    </div>


    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
