@extends('../adminIndex')

@php

@endphp
@section('header')

@endsection


@section('content')
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <input class="form-control" type="date" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <input class="form-control" type="date" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <select name="eventId" id="eventId" class="form-control">
                <option id="placeholderSelect" selected>Событие ... </option>
                @foreach($rentEvents as $rentEvent)
                    <option value="{{$rentEvent->action}}" style="background: {{$rentEvent->color}}">{{$rentEvent->name}}</option>
                @endforeach
            </select>
        </div>
    </div>



@endsection


@section('js')

@endsection


