    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить машину</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/motorPool/add">
    @csrf
    <input type="text" name="userId" value="{$userId}" hidden/>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="manufText" title="Латинские буквы">Марка</label>
                    <input list="oftenCars" type="text" name="manufText" id="manufText" class="form-control" autocomplete="off" required/>

                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="modelText" title="Латинские буквы">Модель</label>
                    <input type="text" name="modelText" id="modelText" class="form-control" autocomplete="off" required/>
                </div>

                <div class="form-group col-md-4 input-group-sm">
                    <label for="generationText" title="Латинские буквы цифры">Поколение</label>
                    <input type="text" name="generationText"  id="generationText" class="form-control" autocomplete="off"/>
                </div>
            </div>

            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="year">Год выпуска</label>
                    <input type="text" name="year" id="year" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="displacement">Обьем двигателя (cc)</label>
                    <input type="text" name="displacement" id="displacement" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="hp">Лошадиных сил (hp)</label>
                    <input type="text" name="hp" id="hp" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="color">Цвет</label>
                    <input type="color" name="color" id="color" class="form-control" autocomplete="off" />
                </div>
            </div>

            <div class="form-row text-center">
                <div class="form-group col-md-5 input-group-sm">
                    <label for="vin">Вин код</label>
                    <input type="text" name="vin" id="vin" class="form-control" autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="regNumber">Рег.номер</label>
                    <input type="text" name="regNumber" {literal} pattern="[A-Z0-9]{8,}" {/literal} id="regNumber" class="form-control" autocomplete="off"/>
                </div>
            </div>


    </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
    </form>
