<div class="modal-header text-center">
    <h6 class="modal-title w-100 font-weight-bold">Информация о машине</h6>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>



<div class="modal-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <strong>Марка</strong>
            </div>
            <div class="col-md-2">
                {{$car->generationName}}
            </div>
            <div class="col-md-2">
                <strong>Двигатель</strong>
            </div>
            <div class="col-md-2">
                {{$car->engineTypeName}}
            </div>
            <div class="col-md-2">
                <strong>Год выпуска</strong>
            </div>
            <div class="col-md-2">
                {{$car->year}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <strong>Модель</strong>
            </div>
            <div class="col-md-2">
                {{$car->modelName}}
            </div>
            <div class="col-md-2">
                <strong>Обьем</strong>
            </div>
            <div class="col-md-2">
                {{$car->displacement}}
            </div>
            <div class="col-md-2">
                <strong>Рег.номер</strong>
            </div>
            <div class="col-md-2">
                {{$car->regNumber}}
            </div>
        </div>

        <div class="row">
            <div class="col-md-2">
                <strong>Поколение</strong>
            </div>
            <div class="col-md-2">
                {{$car->generationName}}
            </div>
            <div class="col-md-2">
                <strong>Сил</strong>
            </div>
            <div class="col-md-2">
                {{$car->hp}}
            </div>
            <div class="col-md-2">
                <strong>Цвет</strong>
            </div>
            <div class="col-md-2">
                {{$car->color}}
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-2">
                <strong>Кузов</strong>
            </div>
            <div class="col-md-2">
                {{$car->typeName}}
            </div>
            <div class="col-md-2">
                <strong>Трансмиссия</strong>
            </div>
            <div class="col-md-2">
                {{$car->transmissionTypeName}}
            </div>
            <div class="col-md-2">
                <strong>Nickname</strong>
            </div>
            <div class="col-md-2">
               {{$car->nickName}}
            </div>
        </div>
            <div class="row border-top mt-2 pt-2">
                <div class="col-md-2">
                    <strong>Вин код</strong>
                </div>
                <div class="col-md-4">
                    {{$car->vin}}
                </div>
                <div class="col-md-2">
                    <strong>Владелец</strong>
                </div>
                <div class="col-md-4">
                    {{$car->subjectOwnerNickname}}
                </div>
            </div>
            @if ($car->subjectFromNickname)
                <div class="row">
                    <div class="col-6"></div>
                    <div class="col-md-2">
                        <strong>Сдается от</strong>
                    </div>
                    <div class="col-md-4">
                        {{$car->subjectFromNickname}}
                    </div>
                </div>
            @endif
            <div class="row border-top mt-2 pt-2">
                <div class="col-md-3">
                    <strong>Начало владения</strong>
                </div>
                <div class="col-md-3">
                    {{$car->dateStart}}
                </div>
                <div class="col-md-3">
                    <strong>Снятие с учета</strong>
                </div>
                <div class="col-md-3">
                    {{$car->dateFinish}}
                </div>
            </div>

            <div class="row border-top mt-2 mb-2 pt-2">
                <div class="col-12 text-center"> <strong>Участвует в группах </strong></div>
            </div>
            @foreach($carGroupsObj as $carGroup)
                <div class="row">
                    <div class="col-md-1"><strong>Группа</strong></div>
                    <div class="col-md-3">{{$carGroup->nickName}}</div>
                    <div class="col-md-2"><strong>Начало</strong></div>
                    <div class="col-md-2">@if ($carGroup->linkStart) {{$carGroup->linkStart->format('d-m-Y')}} @endif</div>
                    <div class="col-md-2"><strong>Окончание</strong></div>
                    <div class="col-md-2">@if ($carGroup->linkFinish) {{$carGroup->linkFinish->format('d-m-Y')}} @endif</div>
                </div>
            @endforeach

        <div class="row mt-2 pt-2">
            <div class="col-md-2">
                <strong>Комментарий</strong>
            </div>
            <div class="col-md-10">
                {{$car->comment}}
            </div>
        </div>
    </div>
</div>

