
<form method="POST" action="/eventRental">
    @csrf
    <input name="eventId" value="{{$eventId}}" hidden/>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">
                Машина
                <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
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
        <div class="form-group col-md-3 input-group-sm">
            <label for="start" title="Начало аренда">Начало аренды</label>
            <input type="datetime-local" name="start" id="start" class="form-control" value="{{$dateTime->toDateTimeLocalString()}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="finish" title="Окончание аренды">Окончание аренды</label>
            <input type="datetime-local" name="finish" id="finish" class="form-control"/>
        </div>
    </div>

        <div class="form-row text-center inputLine">
            <input type="datetime-local" class="dateTime" name="dateTime[]" hidden/>
            <div class="col-1">
                <label></label>
            </div>
            <div class="input-group col-3 mb-3">
                <div class="input-group-prepend">
                    <div class="input-group-text">
                        <input type="checkbox" name="sumCheck[]">
                    </div>
                </div>
                <input type="text" name="sum" class="form-control form-control-sm">
            </div>
        </div>

    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
<script>
    $("#finish").change(function(){
        var start = new Date($('#start').val());
        var end = new Date($('#finish').val());
        var millisBetween = start.getTime() - end.getTime();
        var days = millisBetween / (1000 * 3600 * 24);
        var kolDays=Math.round(Math.abs(days));
        var fromDay,toDay;
        var copyLine=$('.inputLine:first').clone(true);
        $('.inputLine').remove();
        var dateFrom,dateTo;

        for(i=0;i<kolDays;i++){
            dateFrom=start.getDate();
            var dateTimeFormat=start.toISOString();
            copyLine.find(".dateTime").val(dateTimeFormat.substring(0,dateTimeFormat.length-1));
            start.setDate(start.getDate()+1);
            dateTo=start.getDate();
            copyLine.find("label").text(dateFrom+' - '+dateTo);

            copyLine.insertBefore("#last-row");
            copyLine=$('.inputLine:first').clone(true);
        }

    });

</script>
