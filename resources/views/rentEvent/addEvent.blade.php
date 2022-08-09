@extends('../adminIndex')

@section('header')

    <div class="d-flex flex-row">
        <div class="p-2">Добавить : </div>
        <div class="p-2">
            <select name="eventId" id="eventId">
                <option id="placeholderSelect" selected>Событие ... </option>
                @foreach($rentEvents as $rentEvent)
                    <option value="{{$rentEvent->id}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</option>
                @endforeach
            </select>
        </div>
        @if($carObj->id)
            <div class="p-2"><strong>Машина: </strong>{{$carObj->nickName}}</div>
        @endif
        @if($contractObj->id)
            <div class="p-2"><strong>Договор N: </strong>{{$contractObj->number}}</div>
        @endif
        <div class="p-2"><strong>Дата: </strong>{{$dateTime->format('d-m-Y')}}</div>
        @if($parentObj->id)
            <div class="p-2"><strong>Родитель: </strong>{{$parentObj->event->name}}</div>
        @endif
    </div>

@endsection


@section('content')
    <div id="eventForm" class="mt-4">

    </div>
@endsection




@section('js')
<script>
    $( "#eventId" ).change(function() {
        $("#placeholderSelect").remove();

        $("#eventForm").load('/rentEvent/'+$("#eventId").val()+'/create?carId={{$carObj->id}}&date={{$dateTime->format('d-m-Y')}}&contractId={{$contractObj->id}}&parentId={{$parentObj->id}}',function(){
            initDialogWindow();
        });
    });
</script>

@endsection
