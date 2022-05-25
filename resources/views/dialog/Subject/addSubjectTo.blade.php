    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Субьекты</h6>

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
    <div id="subjectSearch">
    @foreach($subjectsObj as $subject)
        <div class="row row-table">
            <div class="col-6">{{$subject->nickname}}</div>
            <div class="col-4"></div>
            <div class="col-2">
                <button class="btn btn-ssm btn-outline-success subjectSearch" data-subjectSearchText="{{$subject->nickname}}" data-subjectSearchId="{{$subject->id}}">
                    <i class="fas fa-user-plus" ></i>
                </button>
            </div>
        </div>
    @endforeach
    </div>
</div>


<script>
$(".subjectSearch").click(function(){
    $("#subjectId").val($(this).attr("data-subjectSearchId")).change();
    $("#subjectText").val($(this).attr("data-subjectSearchText")).change();

    $('#modal').modal('toggle');
});

$("#search").keyup(function(){
    if($("#search").val().length>0)
$("#subjectSearch").load("/subject/search?searchText="+$("#search").val(),function(){
    $(".subjectSearch").click(function(){
        $("#subjectId").val($(this).attr("data-subjectSearchId")).change();
        $("#subjectText").val($(this).attr("data-subjectSearchText")).change();
        $('#modal').modal('toggle');
    });
});

});

</script>

