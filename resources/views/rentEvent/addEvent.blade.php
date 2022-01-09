@extends('../adminIndex')

@section('header')

    <h6 class="m-0 mr-3">Добавить событие</h6><input type="datetime-local" class="form-control form-control-sm" value="{{$dateTime}}" name="dateTime"/>
    <select name="eventId" class="form-control form-control-sm" id="eventId">
        <option id="placeholderSelect" selected>Событие ... </option>
        @foreach($rentEvents as $rentEvent)
            <option value="{{$rentEvent->action}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</option>
        @endforeach
    </select>
@endsection


@section('content')
    <div id="eventForm" class="mt-4">

    </div>
@endsection




@section('js')
<script>
    $( "#eventId" ).change(function() {
        $("#placeholderSelect").remove();
        $("#eventForm").load($("#eventId").val()+'/create');
    });
</script>

@endsection
