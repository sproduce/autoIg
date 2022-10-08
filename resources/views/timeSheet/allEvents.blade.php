@extends('../adminIndex')
@section('css')

@endsection

@section('header')
    <form method="GET" action="" class="w-100">
        <div class="row">
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
            <div class="col-2 input-group-sm">
                <button class="btn btn-sm btn-success" type="submit">Показать</button>
            </div>
        </div>
    </form>
@endsection


@section('content')
    <div class="row align-items-center font-weight-bold border">
        <div class="col-3 text-center">
            Дата
        </div>
        <div class="col-3">
            Событие
        </div>
        <div class="col-3">
            Машина
        </div>
        <div class="col-3">
            Комментарий
        </div>
    </div>

    @foreach($eventsArray as $event)
        <div class="row row-table">
            <div class="col-3">
                {{$event->dateTime->format('d-m-Y H:i')}}
            </div>
            <div class="col-3">
                {{$event->eventName}}
            </div>
            <div class="col-3">
                {{$event->carNickName}}
            </div>
            <div class="col-3">
                {{$event->comment}}
            </div>

        </div>
    @endforeach
@endsection


@section('js')
<script>
    $(function() {
        $("#carSelect").change(function (){
            selectedOption = $("#carSelect option:selected");
            if (selectedOption.val()){
                selectedOption.attr('disabled','disabled');
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
                $("#eventSelect option:first").removeAttr('selected');
                $("#eventSelect option:first").attr('selected','selected');
                newInput = $("#eventId").clone().removeAttr('id').val(selectedOption.val()).prop("disabled", false);
                newInput.insertAfter("#eventId");
            }
        });



    });
</script>


@endsection


