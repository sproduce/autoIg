@extends('../adminIndex')

@section('header')

    <h6 class="m-0 mr-3">Добавить событие</h6><input value="{{$dateTime}}" name="dateTime" id="dateTime" hidden/>
    <select name="eventId" class="form-control form-control-sm" id="eventId">
        <option id="placeholderSelect" selected>Событие ... </option>
        @foreach($rentEvents as $rentEvent)
            <option value="{{$rentEvent->action}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</option>
        @endforeach
    </select>
    <input name="carId" value="{{$carId}}" id="carId" hidden/>
@endsection


@section('content')
    <div id="eventForm" class="mt-4">

    </div>
@endsection




@section('js')
<script>
    $( "#eventId" ).change(function() {
        $("#placeholderSelect").remove();
        $("#eventForm").load($("#eventId").val()+'/create?carId='+$("#carId").val()+'&dateTime='+$("#dateTime").val(),function(){
            initDialogWindow();
        });
    });
</script>

@endsection
