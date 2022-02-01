
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
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" disabled />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор">
                Договор
                <a href="/payment/addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="contractText" name="contractText"  class="form-control" disabled />
            <input name="contractId" id="contractId" value=""  hidden/>
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
                <input type="number" name="timeDuration" id="timeDuration" step="1" class="form-control"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label>+1</label>
                    <div class="btn btn-outline-primary btn-ssm form-control">+1</div>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label>+7</label>
                    <div class="btn btn-outline-primary btn-ssm form-control">+7</div>
                </div>
            </div>

        </div>




    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="dateFinish" title="Окончание аренды">Дата окончания аренды</label>
            <input type="date" name="dateFinish" id="dateFinish" class="form-control" disabled/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="timeFinish" title="Окончание аренды">Время окончания аренды</label>
            <input type="time" step="60" name="timeFinish" id="timeFinish" class="form-control" value="{{$dateTime->format('H:i')}}"/>
        </div>
    </div>

        <div class="form-row text-center inputLine">
            <input type="datetime-local" class="dateTimeSheet" step="any" name="dateTimeSheet[]" hidden/>

            <div class="col-1">
                <label></label>
            </div>
            <div class="input-group col-3 mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="sumCheck[]" checked>
                    </div>
                </div>
                <input type="text" name="sum[]" class="form-control form-control-sm inputLineSum" autocomplete="off">
            </div>
        </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
<script>

    $(function() {
        $('#formSubmit').prop('disabled', true);
    });


    $("#finish").change(function(){
        var start = new Date($('#start').val());

        var end = new Date($('#finish').val());
        var millisBetween = start.getTime() - end.getTime();
        var days = millisBetween / (1000 * 3600 * 24);
        var kolDays=Math.ceil(Math.abs(days));

        var dateFrom,dateTo;

        for(i=0;i<kolDays;i++){
            dateFrom=start.getDate();

            var userTimezoneOffset = start.getTimezoneOffset() * 60000;
            var tmpDate=new Date(start.getTime() - userTimezoneOffset);
            var dateTimeFormat=tmpDate.toISOString();

            copyLine.find(".dateTimeSheet").val(dateTimeFormat.substring(0,dateTimeFormat.length-1));
            start.setDate(start.getDate()+1);
            dateTo=start.getDate();
            copyLine.find("label").text(dateFrom+' - '+dateTo);

            copyLine.insertBefore("#last-row");
            copyLine=$('.inputLine:first').clone(true);
        }

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
        var start = new Date($('#dateStart').val());
        var copyLine=$('.inputLine:first').clone(true);
        var kolDay=parseInt($("#timeDuration").val());
        $('#formSubmit').prop('disabled', false);
        $('.inputLine').remove();
        for(var i=0;i<kolDay;i++){
            var dayFrom=start.getDate();
                start.setDate(start.getDate()+1);
            var dayTo=start.getDate();

            copyLine.find("label").text(dayFrom+' - '+dayTo);

            copyLine.insertBefore("#last-row");
            copyLine=$('.inputLine:first').clone(true);
        }

        $('#dateFinish').val(start.toISOString().split('T')[0]);
        console.log(start.toISOString());
        console.log($("#timeDuration").val());
    });



</script>
