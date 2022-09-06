    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Договор </h6>

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
        <div id="carSearch"></div>
    </div>


<script>
    $(function() {
        if($("#carId").val()){
            searchContract();
        }

    });

    $(".carSearch").click(function(){
        $("#contractId").val($(this).attr("data-contractSearchId")).change();
        $("#contractText").val($(this).attr("data-contractSearchText")).change();
        $('#modal').modal('toggle');
    });

    $("#search").keyup(function(){
        if($("#search").val().length>0){
            searchContract();
        }
    });

    function searchContract(){
        url="/contract/search?searchText="+$("#search").val();
        if ($("#carId").val()) url+="&carId="+$("#carId").val();
        if ($("#subjectId").val()) url+="&subjectId="+$("#subjectId").val();
        $("#carSearch").load(url,function(){
            $(".carSearch").click(function(){
                $("#contractId").val($(this).attr("data-contractSearchId")).change();
                $("#contractText").val($(this).attr("data-contractSearchText")).change();
                $('#modal').modal('toggle');
            });
        });
    }

</script>

