
@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@section('content')
<form method="POST" action="/eventRental">
    @csrf
    <input name="eventId" value="{{$eventObj->id}}" hidden/>
    <input name="duration" value="{{$eventObj->duration}}" hidden/>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">
                Машина
                <a href="/contract/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" readonly required />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор">
                Договор
                <a href="/payment/addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            @if ($contractObj->id)
                <input id="contractText" name="contractText"  class="form-control" value="{{$contractObj->number}}" disabled />
                <input name="contractId" id="contractId" value="{{$contractObj->id}}"  hidden/>
            @else
                <input id="contractText" name="contractText"  class="form-control" disabled />
                <input name="contractId" id="contractId" value=""  hidden/>
            @endif
        </div>
    </div>

    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateStart" title="Начало аренды">Дата начала аренды</label>
            <input type="date" name="dateStart" id="dateStart" class="form-control" value="{{$dateTime->format('Y-m-d')}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeStart" title="Начало аренды">Время начала аренды</label>
            <input type="time" step="60" name="timeStart" id="timeStart" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <div class="form-row">
                <div class="form-group col-md-6 input-group-sm">
                    <label for="timeDuration" title="Количество суток">Количество суток</label>
                    <input type="number" name="timeDuration" id="timeDuration" step="1" class="form-control" value="0"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label>+1</label>
                    <div class="btn btn-outline-primary btn-ssm form-control" id="addDay">+1</div>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label>+7</label>
                    <div class="btn btn-outline-primary btn-ssm form-control" id="add7Day">+7</div>
                </div>
            </div>

        </div>




    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateFinish" title="Окончание аренды">Дата окончания аренды</label>
            <input type="date" name="dateFinish" id="dateFinish" class="form-control" readonly/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeFinish" title="Окончание аренды">Время окончания аренды</label>
            <input type="time" step="60" name="timeFinish" id="timeFinish" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>

        <div class="form-row text-center inputLine">
            <div class="col-1">
                <label></label>
            </div>
            <div class="input-group col-3 mb-3">
                <input type="text" name="sum[]" class="form-control form-control-sm inputLineSum" autocomplete="off">
            </div>
        </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>

    $(function() {
        $('#formSubmit').prop('disabled', true);
    });

    $("#contractId").change(function(){
        $.get( "/api/getContractInfo/"+ $("#contractId").val(), function( data ) {
            $('.inputLineSum').val(data.sum);
        });
    });

    $("#timeStart").change(function(){
        $("#timeFinish").val($("#timeStart").val());
    });

    $("#timeDuration").change(function(){
        var startDate = new Date($('#dateStart').val());
        var copyLine=$('.inputLine:first').clone(true);
        var kolDay=parseInt($("#timeDuration").val());
        $('#formSubmit').prop('disabled', false);
        if (kolDay){$('.inputLine').remove();}
        for(var i=0;i<kolDay;i++){
            var dayFrom=startDate.getDate();
            startDate.setDate(startDate.getDate()+1);
            var dayTo=startDate.getDate();
            copyLine.find("label").text(dayFrom+' - '+dayTo);
            copyLine.insertBefore("#last-row");
            copyLine=$('.inputLine:first').clone(true);
        }

        $('#dateFinish').val(startDate.toISOString().split('T')[0]);
        $("#timeFinish").val($("#timeStart").val());
    });



    $("#addDay").click(function(){
        $("#timeDuration").val(parseInt($("#timeDuration").val())+1);
        $("#timeDuration").change();
    });
    $("#add7Day").click(function(){
        $("#timeDuration").val(parseInt($("#timeDuration").val())+7);
        $("#timeDuration").change();
    });

    $("#timeFinish").change(function(){
        var timeFrom= new Date(),timeTo=new Date(),dateTo=new Date($('#dateFinish').val());
        timeTo.setHours(parseInt($("#timeFinish").val().split(':')[0]),parseInt($("#timeFinish").val().split(':')[1]) );
        timeFrom.setHours(parseInt($("#timeStart").val().split(':')[0]),parseInt($("#timeStart").val().split(':')[1]) );
        var deltaminute=(timeTo-timeFrom)/60/1000;
        if (timeTo-timeFrom>0){
            var copyLine=$('.inputLine:first').clone(true);
            copyLine.find("label").text(dateTo.getDate()+" ("+deltaminute+")m");
            copyLine.find("input").addClass("border border-danger");
            copyLine.insertBefore("#last-row");
        }
    });


</script>
@endsection
