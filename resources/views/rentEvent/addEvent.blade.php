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
            <div class="p-2">Машина: {{$carObj->nickName}}</div>
        @endif
        @if($contractObj->id)
            <div class="p-2">Договор N: {{$contractObj->number}}</div>
        @endif

        <div class="p-2">Дата: {{$dateTime->format('d-m-Y')}}</div>
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

        $("#eventForm").load('/rentEvent/'+$("#eventId").val()+'/create?carId={{$carObj->id}}&date={{$dateTime->format('d-m-Y')}}&contractId={{$contractObj->id}}',function(){
            initDialogWindow();
        });
    });
</script>

@endsection
