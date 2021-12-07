    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Группа Машин </h6>

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
    <div id="carGroupSearch">
    @foreach($carGroups as $carGroup)
        <div class="row row-table">
            <div class="col-6">{{$carGroup->name}}</div>
            <div class="col-4"></div>
            <div class="col-2">
                <button class="btn btn-ssm btn-outline-success carGroupSearch" data-carGroupSearchText="{{$carGroup->name}} {{$carGroup->nickName}}" data-carGroupSearchId="{{$carGroup->id}}">
                    <i class="fas fa-user-plus" ></i>
                </button>
            </div>
        </div>
    @endforeach
    </div>
</div>


<script>
$(".carGroupSearch").click(function(){
    console.log($(this).attr("data-carGroupSearchText"));
    $("#carGroupId").val($(this).attr("data-carGroupSearchId"));
    $("#carGroupText").val($(this).attr("data-carGroupSearchText"));
    $('#modal').modal('toggle');
});

$("#search").keyup(function(){
    if($("#search").val().length>0)
$("#carGroupSearch").load("/carGroup/search?carGroupText="+$("#search").val(),function(){
    $(".carGroupSearch").click(function(){
        $("#carGroupId").val($(this).attr("data-carGroupSearchId"));
        $("#carGroupText").val($(this).attr("data-carGroupSearchText"));
        $('#modal').modal('toggle');
    });
});

});

</script>

