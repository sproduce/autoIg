    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Водитель </h6>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row">
                <label for="search" class="col-sm-2 col-form-label form-control-sm">Поиск</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control form-control-sm" id="search" name="search" autocomplete="off"/>
                </div>
            </div>
        </div>
        <div class="row align-items-center font-weight-bold border">
            <div class="col-sm-4">Фамилия | Имя | Отчество</div>
            <div class="col-sm-3">Дата рождения</div>
            <div class="col-sm-4">Телефон</div>
        </div>
        <div id="carDriverSearch">
        @foreach($carDrivers as $carDriver)
                <div class="row row-table">
                    <div class="col-sm-4">{{$carDriver->surname}} {{$carDriver->name}} {{$carDriver->patronymic}}</div>
                    <div class="col-sm-3">{{$carDriver->birthday}}</div>
                    @if($carDriver->contacts->count())
                        <div class="col-sm-4" title="@foreach($carDriver->contacts as $contact) {{$contact->phone}} @endforeach">
                            {{$carDriver->contacts[0]->phone}}
                        </div>
                    @else
                        <div class="col-sm-4">Не добавлен</div>
                    @endif
                    <div class="col-sm-1">
                        <button class="btn btn-ssm btn-outline-success driverSearch" data-driverSeachText="{{$carDriver->surname}} {{$carDriver->name}} {{$carDriver->patronymic}}" data-driverSearchId="{{$carDriver->id}}">
                            <i class="fas fa-user-plus" ></i>
                        </button>
                    </div>
                </div>
        @endforeach
        </div>

    </div>


<script>
    $(".driverSearch").click(function(){
        $("#driverId").val($(this).attr("data-driverSearchId"));
        $("#driverText").val($(this).attr("data-driverSeachText"));
        $('#modal').modal('toggle');
    });

$("#search").keyup(function(){
    if($("#search").val().length>0)
    $("#carDriverSearch").load("/carDriver/search?driverText="+$("#search").val(),function(){
        $(".driverSearch").click(function(){
            $("#driverId").val($(this).attr("data-driverSearchId"));
            $("#driverText").val($(this).attr("data-driverSeachText"));
            $('#modal').modal('toggle');
        });
    });

});

</script>

