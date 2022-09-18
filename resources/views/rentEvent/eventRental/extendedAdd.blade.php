@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <div class="row">
        <div class="col-2">Последнее событие </div>
        <div class="col-1"><strong>Дата:</strong></div>
        <div class="col-2" id="dateTimeEnd"> </div>
        <div class="col-1"><strong>Машина:</strong></div>
        <div class="col-2" id="carNickName"></div>
        <div class="col-1"><strong>Договор:</strong></div>
        <div class="col-2" id="contractNumber"></div>

    </div>
    <div class="row mb-5 mt-1">
        <div class="col-1" id="extendButton">
            <button class="btn btn-ssm btn-outline-success">Продлить</button>
        </div>
    </div>

<form method="POST" action="/rentEvent/{{$eventObj->id}}">
    <input type="number" name="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
    <input type="number" name="duration" value="1440" hidden/>
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Автомобиль">Машина</label>
                <a href="/motorPool/addCarTo" id="addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            <input id="carText" class="form-control" value="{{$carObj->nickName}}" readonly required />
            <input id="carId" name="carId" class="form-control" value="{{$carObj->id}}" hidden />
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор"> Договор </label>
                <a href="/contract/addContractTo" id="addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>

            @if ($contractObj->id)
                <input id="contractText" name="contractText"  class="form-control" value="{{$contractObj->number}}" disabled />
                <input name="contractId" id="contractId" value="{{$contractObj->id}}"  hidden/>
            @else
                <input id="contractText" name="contractText"  class="form-control" disabled />
                <input name="contractId" id="contractId" value=""  hidden/>
            @endif
        </div>


        <div class="form-group col-md-2 input-group-sm">
            <label for="mileage" title="Пробег">Пробег</label>
            <input type="number" name="mileage" id="mileage" class="form-control" value=""/>
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
{{--    <div class="form-row text-center">--}}
{{--        <div class="form-group col-md-2 input-group-sm">--}}
{{--            <label for="dateFinish" title="Окончание аренды">Дата окончания аренды</label>--}}
{{--            <input type="date" name="dateFinish" id="dateFinish" class="form-control" readonly/>--}}
{{--        </div>--}}
{{--        <div class="form-group col-md-3 input-group-sm">--}}
{{--            <label for="timeFinish" title="Окончание аренды">Время окончания аренды</label>--}}
{{--            <input type="time" step="60" name="timeFinish" id="timeFinish" class="form-control" value="{{$dateTime->format('H:i')}}"/>--}}
{{--        </div>--}}
{{--    </div>--}}

        <div class="form-row text-center inputLine mb-1">
            <div class="col-3">
                <label class="m-0 pt-1"></label>
            </div>
            <div class="input-group col-3">
                <input type="text" name="sum[]" class="form-control form-control-sm inputLineSum" value="{{$contractObj->price ?:0}}" autocomplete="off">
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

    var lastEvent;


    $(function() {
        $('#formSubmit').prop('disabled', true);
        getLastEvent();
        $('.inputLineSum').hide();
    });

    $("#contractId").change(function(){
        $.get( "/api/getContractInfo/"+ $("#contractId").val(), function( data ) {
            $('.inputLineSum').val(data.price);
        });
    });

    $("#timeStart").change(function(){
        compareDateTime();

    });

    $("#dateStart").change(function(){
        compareDateTime();
    });


    $("#timeDuration").change(function(){
        $('.inputLineSum').show();
        var startDate = new Date($('#dateStart').val());
        var copyLine = $('.inputLine:first').clone(true);
        var kolDay = parseInt($("#timeDuration").val());
        $('#formSubmit').prop('disabled', false);
        if (kolDay){$('.inputLine').remove();}
        for(var i=0;i<kolDay;i++){
            let dayFrom = startDate.getDate();
            let monthFrom = startDate.getMonth()+1;
            let yearFrom = startDate.getFullYear();
            if (dayFrom<10) dayFrom = '0'+ dayFrom;
            if (monthFrom<10) monthFrom = '0'+ monthFrom;
            let stringFrom = dayFrom+'-'+monthFrom+'-'+yearFrom;

            startDate.setDate(startDate.getDate()+1);
            let dayTo = startDate.getDate();
            let monthTo = startDate.getMonth()+1;
            let yearTo = startDate.getFullYear();
            if (dayTo<10) dayTo = '0'+ dayTo;
            if (monthTo<10) monthTo = '0'+ monthTo;
            let stringTo = dayTo+'-'+monthTo+'-'+yearTo;
            copyLine.find("label").text(stringFrom+' - '+stringTo);
            copyLine.insertBefore("#last-row");
            copyLine=$('.inputLine:first').clone(true);
        }

        $('#dateFinish').val(startDate.toISOString().split('T')[0]);
        $("#timeFinish").val($("#timeStart").val());
    });

    $("#extendButton").click(function() {
        $("#dateStart").attr('readonly', true);
        $("#timeStart").attr('readonly', true);
        $("#addCar").remove();
        $("#addContract").remove();
        eventDateEnd = new Date(lastEvent.dateTimeEnd);
        // eventDateEnd.toISOString(true);
        $("#dateStart").val(new Date(eventDateEnd.getTime()-eventDateEnd.getTimezoneOffset()*60000).toISOString().substring(0,10));
        $("#timeStart").val(new Date(eventDateEnd.getTime()-eventDateEnd.getTimezoneOffset()*60000).toISOString().substring(11,16));
        $("#contractText").val(lastEvent.contractNumber);
        $("#contractId").val(lastEvent.contractId);
        $(".inputLineSum").val(lastEvent.contractPrice);
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

    $("#carId").change(function(){
        getLastEvent();
    })


    function compareDateTime(){
        lastDate = new Date(lastEvent.dateTimeEnd);
        startDate = new Date($("#dateStart").val()+' '+$("#timeStart").val());
        if (lastDate.getTime()>startDate.getTime()){
            alert('Выбранная дата раньше окончания предидущего события.');
            $("#dateStart").val(new Date(lastDate.getTime()-lastDate.getTimezoneOffset()*60000).toISOString().substring(0,10));
            $("#timeStart").val(new Date(lastDate.getTime()-lastDate.getTimezoneOffset()*60000).toISOString().substring(11,16));
        }



    }


    function getLastEvent(){
        $.getJSON('/timesheet/getLastRecord/'+{{$eventObj->id}}+'/'+$("#carId").val(),function(data){
            // dateTimeObj = new Date(data.timeSheet.dateTime);
            if (data.timeSheetId){
                $("#extendButton").show();
                $("#dateTimeEnd").text(data.dateTimeEnd);
                lastEvent = data;
            } else {
                $("#dateTimeEnd").text("Нет события");
                $("#extendButton").hide();
            }

            if (data.carId){
                $("#carNickName").text(data.carNickName);
            } else {
                $("#carNickName").text("Не указана");
            }
            if (data.contractId){
                $("#contractNumber").text(data.contractNumber);
            } else {
                $("#contractNumber").text("Не договора");
            }
        });
    }

</script>
@endsection
