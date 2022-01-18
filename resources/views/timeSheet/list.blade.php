@extends('../adminIndex')

@php



    $motorPool=$timeSheetCollect->get('motorPools');
    $timeSheets=$timeSheetCollect->get('timeSheets');
@endphp
@section('header')

            <h6 class="m-0 mr-3">Табель</h6>


@endsection


@section('content')

@php


@endphp

<form type="GET" action="">
    <div class="row mb-3 text-center">

        <input type="date" name="currentDate" value="{{$currentDate->format('Y-m-d')}}"/>
        <input type="submit" value="Показать"/>
    </div>

</form>

<table>
    <tr>
        <th class="border">#</th>
        @foreach($periodDate as $date)
            @if($date==$currentDate)
            <th class="border text-center  table-primary">{{$date->isoFormat('ddd')}}
                    {{$date->isoFormat('D')}}
            </th>
                @else
                <th class="border text-center">{{$date->isoFormat('ddd')}}
                    <a href="?currentDate={{$date->format('Y-m-d')}}">
                        {{$date->isoFormat('D')}}
                    </a>
                </th>
            @endif
        @endforeach
    </tr>

    @foreach($motorPool as $car)
            <tr class="carInfo" data-carid="{{$car->id}}">
                <td class="border">
                    {{$car->nickName}}
                </td>

                @foreach($periodDate as $date)
                    @php
                        $fromDate=$date->format('Y-m-d');
                        $toDate=$date->addDays(1)->format('Y-m-d');
                    @endphp
                    <td class="border p-0 timeClickable" data-datetime="{{$fromDate}}">
                        @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                            <div class="progress mb-1" style="height: 2px;">
                                <div class="progress-bar" role="progressbar" style="background-color:{{$timeSheet->event->color}};width: 100%;"></div>
                            </div>
                        @empty

                        @endforelse
                    </td>
                @endforeach
            </tr>
    @endforeach



</table>



@endsection


@section('js')
<script>
    $(".timeClickable").dblclick(function(e) {
    var carId=$(this).closest('.carInfo').data('carid');
    var dateTime=$(this).data('datetime');


switch(true){
    case e.ctrlKey:
        $(location).prop('href','/timesheet/add?carId='+carId+'&date='+dateTime);
    break;
    case e.altKey:
        DialogUser('/timesheet/edit?carId='+carId+'&date='+dateTime);
    break;
    default:
    DialogUser('/timesheet/info?carId='+carId+'&date='+dateTime);
}



});
</script>
@endsection


