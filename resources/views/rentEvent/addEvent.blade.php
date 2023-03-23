@extends('../adminIndex')

@section('header')

    <div class="d-flex flex-row w-100">
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
    
            @foreach($rentEvents as $rentEvent)
                @if ($loop->first || $loop->index==12 || $loop->index==24 )
                    <div class="d-flex flex-row mt-1">
                @endif
                    <button class="border-0 ml-1 choice" data-eventid="{{$rentEvent->id}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</button>

                @if ($loop->last || $loop->iteration==12 || $loop->iteration==24)
                    </div>
                @endif
            @endforeach
    
@endsection


@section('content')
    <div id="eventForm" class="mt-4">

    </div>
@endsection




@section('js')
    @if($eventId)
<script>
    $("#eventForm").load('/rentEvent/'+{{$eventId}}+'/create?carId={{$carObj->id}}&date={{$dateTime->format('d-m-Y')}}&contractId={{$contractObj->id}}&parentId={{$parentObj->id}}');
</script>
    @endif

<script>
    $( ".choice" ).click(function() {
        $("#eventForm").load('/rentEvent/'+$(this).data('eventid')+'/create?carId={{$carObj->id}}&date={{$dateTime->format('d-m-Y')}}&contractId={{$contractObj->id}}&parentId={{$parentObj->id}}',function(){
            initDialogWindow();
            initClearButton();
        });
    });
</script>

@endsection
