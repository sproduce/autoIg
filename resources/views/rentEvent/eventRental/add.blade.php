
@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        @if($carObj->id)
            <h6 class="w-100 text-left"><strong>Машина: </strong> {{$carObj->nickName}}</h6>
        @endif
            <h6 class="w-100 text-left"><strong>Событие: </strong>{{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    @if($eventDataObj->id)
        @include('rentEvent.eventRental.addOld')
    @else
        @include('rentEvent.eventRental.extendedAdd')
    @endif
@endsection
