    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Машина </h6>

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
        <div id="carDriverSearch">
        @foreach($cars as $car)
            <div class="row">
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-2"></div>
                <div class="col-2">
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
    $("#carDriverSearch").load("/carDriver/search?driverText="+$("#search").val(),function(){
        $(".driverSearch").click(function(){
            $("#driverId").val($(this).attr("data-driverSearchId"));
            $("#driverText").val($(this).attr("data-driverSeachText"));
            $('#modal').modal('toggle');
        });
    });

});

</script>

