    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Информация о машине</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>



    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    Марка : {{$car->generation->model->brand->name}}
                </div>
                <div class="col-md-4">
                    Модель : {{$car->generation->model->name}}
                </div>
                <div class="col-md-4">
                    Поколение : {{$car->generation->name}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    Кузов : {{$car->body->name}}
                </div>
                <div class="col-md-4">
                    Трансмиссия : {{$car->transmission->name}}
                </div>
                <div class="col-md-4">
                    Тип двигателя : {{$car->engine->name}}

                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Обьем двигателя : {{$car->displacement}}
                </div>
                <div class="col-md-3">
                    Лошадиных сил : {{$car->hp}}
                </div>
                <div class="col-md-3">
                    Год выпуска : {{$car->year}}
                </div>
                <div class="col-md-3">
                    Цвет : {{$car->color}}
                </div>

            </div>

            <div class="row">
                <div class="col-md-5">
                    Вин код : {{$car->vin}}
                </div>
                <div class="col-md-3">
                    Рег.номер : {{$car->regNumber}}
                </div>
                <div class="col-md-4">
                    Владелец : {{$car->owner->name}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    Комментарий : {{$car->nickName}}
                </div>
            </div>
        </div>
    </div>

