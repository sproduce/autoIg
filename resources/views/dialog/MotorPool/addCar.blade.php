    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Добавить машину</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
<form method="POST" action="/motorPool/add">
    <input type="number" name="id" value="{{$carConfiguration->id}}" hidden />
    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="manufId" title="Латинские буквы">Марка</label>
                    <select name="manufId" id="manufId" class="form-control">
                        @if ($carConfiguration->brandId)
                            <option value="{{$carConfiguration->brandId}}">{{$carConfiguration->brandName}}</option>
                        @else
                            <option value="0" id="firstBrandOption">Выберите марку</option>
                        @endif
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="modelId" title="Латинские буквы">Модель</label>
                    <select name="modelId" id="modelId" class="form-control" disabled>
                        @if ($carConfiguration->modelId)
                            <option value="{{$carConfiguration->modelId}}">{{$carConfiguration->modelName}}</option>
                        @endif
                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="generationId">Поколение</label>
                    <select name="generationId"  id="generationId" class="form-control" required readonly>
                        @if ($carConfiguration->generationId)
                            <option value="{{$carConfiguration->generationId}}">{{$carConfiguration->generationName}}</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="type">Кузов</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($types['body'] as $type)
                            <option value="{{$type->id}}" @if($carConfiguration->typeId == $type->id) selected @endif>{{$type->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="transmissionTypeId">Трансмиссия</label>
                    <select name="transmissionTypeId" id="transmissionTypeId" class="form-control">

                        @foreach($types['transmission'] as $transmission)
                            <option value="{{$transmission->id}}" @if($carConfiguration->transmissionTypeId == $transmission->id) selected @endif>{{$transmission->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="engineTypeId">Тип двигателя</label>
                    <select name="engineTypeId" id="engineTypeId" class="form-control">
                        @foreach($types['engine'] as $engine)
                            <option value="{{$engine->id}}" @if($carConfiguration->engineTypeId == $engine->id) selected @endif>{{$engine->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="displacement">Обьем двигателя (cc)</label>
                    <input type="number" name="displacement" id="displacement" class="form-control" value="{{$carConfiguration->displacement}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="hp">Лошадиных сил (hp)</label>
                    <input type="number" name="hp" id="hp" class="form-control" value="{{$carConfiguration->hp}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="year">Год выпуска</label>
                    <input type="number" name="year" id="year" class="form-control" value="{{$carConfiguration->year}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="color">Цвет</label>
                    <input type="text" name="color" id="color" value="{{$carConfiguration->color}}" class="form-control"/>
                </div>

            </div>

            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="vin">Вин код</label>
                    <input type="text" name="vin" id="vin" class="form-control" value="{{$carConfiguration->vin}}" required autocomplete="off"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="regNumber">Рег.номер</label>
                    <input type="text" name="regNumber" id="regNumber" class="form-control" value="{{$carConfiguration->regNumber}}" required autocomplete="off"/>
                </div>

                <div class="form-group col-md-3 input-group-sm">
                    <label for="subjectIdOwner">Владелец</label>
                    <select name="subjectIdOwner" id="subjectIdOwner" class="form-control">
                    @foreach($owners as $owner)
                        <option value="{{$owner->id}}" @if($carConfiguration->subjectIdOwner == $owner->id) selected @endif>{{$owner->nickname}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="subjectIdFrom">Аренда от</label>
                    <select name="subjectIdFrom" id="subjectIdFrom" class="form-control">
                        <option value=""></option>
                        @foreach($subjectsObj as $subject)
                            <option value="{{$subject->id}}" @if($carConfiguration->subjectIdFrom == $subject->id) selected @endif>{{$subject->nickname}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="dateStart">Начало владения</label>
                    <input type="date" name="dateStart" id="dateStart" value="{{$carConfiguration->dateStart}}" required class="form-control"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="dateFinish">Снята с учета</label>
                    <input type="date" name="dateFinish" id="dateFinish" value="{{$carConfiguration->dateFinish}}" class="form-control"/>
                </div>
                <div class="form-group col-md-4 input-group-sm">
                    <label for="nickName">NickName</label>
                    <input type="text" name="nickName" id="nickName" class="form-control" value="{{$carConfiguration->nickName}}" autocomplete="off" />
                </div>
            </div>
            <div class="form-row text-center">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control" value="{{$carConfiguration->comment}}" autocomplete="off" />
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Сохранить">
    </div>
</form>
    <script>
        $(function()
        {
            $('#manufId').change(function() {
                $('#firstBrandOption').remove();
                $('#modelId').empty();
                $('#generationId').empty();
                $('#generationId').attr('disabled',true);
                $.get("/api/getModels",{brandId:$(this).val()}).done(function( data ) {
                    if (data.length){
                        var html = '';
                        for (var i = 0; i< data.length; i++) {
                            html += '<option value="' + data[i].id + '">'+ data[i].name +'</option>';
                        }
                        $('#modelId').append(html);
                        $('#modelId').removeAttr('disabled');
                        $('#modelId').trigger('change');
                    } else {
                        $('#modelId').attr('disabled',true);
                    }
                });
            });



            $('#modelId').change(function() {
                $('#generationId').empty();
                $.get("/api/getGenerations",{modelId:$('#modelId').val()}).done(function( data ) {
                    if (data.length){
                        var html = '';
                        for (var i = 0; i< data.length; i++) {
                            if (!data[i].finish){
                                data[i].finish='н.в.'
                            }
                            html += '<option value="' + data[i].id + '">'+ data[i].name +'  ('+data[i].start +'-'+data[i].finish+')</option>';
                        }

                        $('#generationId').append(html);
                        $('#generationId').removeAttr('disabled');
                    } else {
                        $('#generationId').attr('disabled',true);
                    }
                });
            });


        });
    </script>
