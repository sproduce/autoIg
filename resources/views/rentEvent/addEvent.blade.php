@extends('../adminIndex')

@section('header')

    <div class="d-flex flex-row">
        <div class="p-2">Добавить : </div>
        <div class="p-2">
            <select name="eventId" id="eventId">
                <option id="placeholderSelect" selected>Событие ... </option>
                @foreach($rentEvents as $rentEvent)
                    <option value="{{$rentEvent->action}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</option>
                @endforeach
            </select>
        </div>
        @if($carObj->id)
            <div class="p-2">Машина: {{$carObj->nickName}}</div>
        @endif

        <div class="p-2">Дата: {{$dateTime->format('d-m-Y')}}</div>
    </div>

    <input value="{{$dateTime->format('d-m-Y')}}" name="dateTime" id="dateTime" hidden/>

    <input name="currentCarId" value="{{$carObj->id}}" id="currentCarId" hidden/>

@endsection


@section('content')
    <div id="eventForm" class="mt-4">

    </div>
@endsection




@section('js')
<script>
    $( "#eventId" ).change(function() {
        $("#placeholderSelect").remove();

        $("#eventForm").load('/'+$("#eventId").val()+'/create?carId='+$("#currentCarId").val()+'&date='+$("#dateTime").val(),function(){
            initDialogWindow();
        });
    });
</script>

@endsection
