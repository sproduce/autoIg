@extends('../adminIndex')

@php

@endphp
@section('header')
    <div class="d-flex flex-row">
        <div class="p-2 input-group-sm">
            <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
        </div>
        <div class="p-2 input-group-sm">
            <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
        </div>
        <div class="p-2 input-group-sm">
            <select name="eventId" id="eventId" class="form-control">
                <option id="placeholderSelect" selected>Событие ... </option>
                @foreach($rentEvents as $rentEvent)
                    <option value="{{$rentEvent->id}}" style="background: {{$rentEvent->color}}" @if ($rentEvent->id==$eventObj->id)selected @endif>{{$rentEvent->name}}</option>
                @endforeach
            </select>
        </div>
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

            $("#eventForm").load('/rentEvent/'+$("#eventId").val()+'?fromDate='+$("#fromDate").val()+'&toDate='+$("#toDate").val(),function(){
                initDialogWindow();
            });
        });
    </script>

    @if ($eventObj->id)
        <script>
            $(function() {
                $("#placeholderSelect").remove();

                $("#eventForm").load('/{{$eventObj->action}}?fromDate='+$("#fromDate").val()+'&toDate='+$("#toDate").val(),function(){
                    initDialogWindow();
            });});
        </script>
        @endif
@endsection


