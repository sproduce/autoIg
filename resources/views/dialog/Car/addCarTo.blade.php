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
    <div id="carSearch">
    @foreach($cars as $car)
        <div class="row row-table">
            <div class="col-6">{{$car->nickName}} {{$car->regNumber}}</div>
            <div class="col-4"></div>
            <div class="col-2">
                <button class="btn btn-ssm btn-outline-success carSearch" data-carSeachText="{{$car->nickName}} {{$car->generation->model->brand->name}} {{$car->generation->model->name}} {{$car->generation->name}} {{$car->regNumber}} {{$car->color}}" data-carSearchId="{{$car->id}}">
                    <i class="fas fa-user-plus" ></i>
                </button>
            </div>
        </div>
    @endforeach
    </div>
</div>


<script>
$(".carSearch").click(function(){
    $("#carId").val($(this).attr("data-carSearchId")).change();
    $("#carText").val($(this).attr("data-carSeachText")).change();

    $('#modal').modal('toggle');
});

$("#search").keyup(function(){
    if($("#search").val().length>0)
$("#carSearch").load("/motorPool/search?searchText="+$("#search").val(),function(){
    $(".carSearch").click(function(){
        $("#carId").val($(this).attr("data-carSearchId")).change();
        $("#carText").val($(this).attr("data-carSeachText")).change();
        $('#modal').modal('toggle');
    });
});

});

</script>

