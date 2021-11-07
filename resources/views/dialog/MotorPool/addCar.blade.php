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
                <div class="form-group col-md-3 input-group-sm">
                    <label for="manufId" title="Латинские буквы">Марка</label>
                    <select name="manufId" id="manufId" class="form-control">
                        <option value="0" id="firstBrandOption">Выберите марку</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="modelId" title="Латинские буквы">Модель</label>

                    <select name="modelId" id="modelId" class="form-control" disabled>
                    </select>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="generationId">Поколение</label>
                    <select name="generationId"  id="generationId" class="form-control" disabled>
                    </select>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="type">Кузов</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($types as $type)
                        <option value="{{$type->id}}">{{$type->name}}</option>
                        @endforeach
                    </select>
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
                    <label for="regNumber">Рег.номер</label>
                    <input type="text" name="regNumber" id="regNumber" class="form-control" autocomplete="off"/>
                </div>
            </div>

            <div class="form-row text-center">
                <div class="form-group col-md-4 input-group-sm">
                    <label for="vin">Вин код</label>
                    <input type="text" name="vin" id="vin" class="form-control" autocomplete="off"/>
                </div>

                <div class="form-group col-md-2 input-group-sm">
                    <label for="color">Цвет</label>
                    <input type="color" name="color" id="color" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="owner">Владелец</label>
                    <input type="text" name="owner" id="owner" class="form-control" autocomplete="off" />
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="nickName">NickName</label>
                    <input type="text" name="nickName" id="nickName" class="form-control" autocomplete="off" />
                </div>
            </div>


    </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Добавить">
    </div>
    </form>


    <script>
        function getOptions (dataArray){
            var html = '';
            for (var i = 0; i< dataArray.length; i++) {
                html += '<option value="' + dataArray[i].id + '">'+ dataArray[i].name + '</option>';
            }
            return html;
        }


        $(function()
        {
            $('#manufId').change(function() {
                $('#firstBrandOption').remove();
                $('#modelId').empty();
                $('#generationText').empty();
                $('#generationText').attr('disabled',true);
                $.get("/api/getModels",{brandId:$(this).val()}).done(function( data ) {
                    if (data.length){
                        $('#modelId').append(getOptions(data));
                        $('#modelId').removeAttr('disabled');
                        $('#modelId').trigger('change');
                    } else {
                        $('#modelText').attr('disabled',true);
                    }
                });
            });



            $('#modelId').change(function() {
                $('#generationId').empty();
                $.get("/api/getGenerations",{modelId:$('#modelId').val()}).done(function( data ) {
                    if (data.length){
                        $('#generationId').append(getOptions(data));
                        $('#generationId').removeAttr('disabled');
                    } else {
                        $('#generationId').attr('disabled',true);
                    }
                });
            });


        });
    </script>
