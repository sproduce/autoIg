@extends('../adminIndex')
@section('css')

@endsection

@section('header')
    <form method="GET" action="" class="w-100">
        <div class="row">   
            <div class="col-1 input-group-sm">
                <a href="/timesheet/add" class="btn btn-ssm btn-outline-success" title="добавить событие"><i class="far fa-plus-square"></i></a>
            </div>
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <input type="number" id="eventId" class="eventId" name="eventId[]" disabled hidden/>
                <select id="eventSelect">
                    <option value="0">Событие</option>
                    @foreach($eventsObj as $eventObj)
                        <option value="{{$eventObj->id}}">{{$eventObj->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 input-group-sm">
                <input type="number" class="carId" id="carId" name="carId[]" disabled hidden/>
                <select id="carSelect">
                    <option value="0">Машина</option>
                    @foreach($carsObj as $carObj)
                        <option class="selectOption" value="{{$carObj->id}}">{{$carObj->nickName}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 input-group-sm">
                <input class="form-check-input" type="checkbox" id="delete" name="delete"/>
                <label for="delete">Удаленные</label>
            </div>
            <div class="col-1 input-group-sm">
                <button class="btn btn-sm btn-success" type="submit">Показать</button>
            </div>
        </div>
    </form>
@endsection


@section('content')
    <div class="row align-items-center font-weight-bold border">
        <div class="col-2">Дата</div>
        <div class="col-2">Машина</div>
        <div class="col-1">Событие</div>
        <div class="col-2">Сумма</div>
        <div class="col-2">Комментарий</div>
    </div>

    @foreach($eventsArray as $event)
        <div class="row row-table" data-event="{{$event->eventId}}" data-id="{{$event->dataId}}">
            <div class="col-2 text-right">
                <a href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->dateTime->format("d-m-y")}} {{$event->dateTime->format("H:i")}}
                @if($event->dateTimeEnd)
                    <br/>
                    {{$event->dateTimeEnd->format("d-m-y")}} {{$event->dateTimeEnd->format("H:i")}}
                @endif
            </div>

            <div class="col-2">
                <a href="/motorPool/carInfo/{{$event->carId ?? 0}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                {{$event->carNickName}}
            </div>
            <div class="col-1">
                {{$event->eventName}}
            </div>
            <div class="col-2">
                {{$event->toPaymentSum}} / {{$event->toPaymentPaymentSum}}
            </div>
            <div class="col-2">
                {{$event->comment}}
            </div>
            <div class="col-2">

            </div>
            <div class="col-1 text-right">
                <a class="btn btn-ssm btn-outline-warning" href="/rentEvent/{{$event->eventId}}/{{$event->dataId ?? 0}}/edit?needParent=1" title="Редактировать"> <i class="far fa-edit"></i></a>
                <button class="btn btn-ssm btn-outline-danger deleteButton" title="Удалить"><i class="fas fa-trash"></i> </button>
            </div>

        </div>
    @endforeach
@endsection


@section('js')
    <script src="{{ asset('js/rentEvent.js') }}" defer></script>
<script>

    $(function() {
        $(".deleteButton").click(function(){
            deleteEvent(this);
        });

        $("#carSelect").change(function (){
            selectedOption = $("#carSelect option:selected");
            if (selectedOption.val()){
                selectedOption.attr('disabled','disabled');
                selectedOption.addClass("bg-info");
                selectedOption.removeAttr('selected');
                $("#carSelect option:first").removeAttr('selected');
                $("#carSelect option:first").attr('selected','selected');
                newInput = $("#carId").clone().removeAttr('id').val(selectedOption.val()).prop("disabled", false);
                newInput.insertAfter("#carId");
            }
        });


        $("#eventSelect").change(function (){
            selectedOption = $("#eventSelect option:selected");
            if (selectedOption.val()){
                selectedOption.attr('disabled','disabled');
                selectedOption.removeAttr('selected');
                selectedOption.addClass("bg-info");
                $("#eventSelect option:first").removeAttr('selected');
                $("#eventSelect option:first").attr('selected','selected');
                newInput = $("#eventId").clone().removeAttr('id').val(selectedOption.val()).prop("disabled", false);
                newInput.insertAfter("#eventId");
            }
        });



    });
</script>


@endsection


