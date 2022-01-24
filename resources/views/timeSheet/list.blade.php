@extends('../adminIndex')

@php
    $motorPool=$timeSheetCollect->get('motorPools');
    $timeSheets=$timeSheetCollect->get('timeSheets');
@endphp
@section('header')

    <h6 class="m-0 mr-3">Табель</h6>


@endsection


@section('content')

    <div class="container-fluid overflow-auto">

        <div class="row flex-nowrap">
            <div class="col p-0 text-center border carInfoSize">
                <div class="p-0">#</div>
            </div>
            @foreach($periodDate as $date)
                @if($date==$currentDate)
                    <div class="col daySize p-0 text-center border bg-primary">
                        <div class="p-0">{{$date->isoFormat('ddd')}}<br/>{{$date->isoFormat('D')}}</div>
                    </div>
                @else
                    <div class="col daySize p-0 text-center border">
                        <div class="p-0">{{$date->isoFormat('ddd')}}<br/>
                            <a href="?currentDate={{$date->format('Y-m-d')}}">{{$date->isoFormat('D')}}</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        @foreach($motorPool as $car)
            <div class="row flex-nowrap carInfo" data-carid="{{$car->id}}">
                <div class="col p-0 text-left border carInfoSize">
                    <div class="p-0">{{$car->nickName}}</div>
                </div>
                @foreach($periodDate as $date)
                    @php
                        $fromDate=$date->format('Y-m-d');
                        $toDate=$date->addDays(1)->format('Y-m-d');
                    @endphp
                    <div class="col p-0 daySize border timeClickable" data-datetime="{{$fromDate}}">
                        <div class="p-0">
                            @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                <div class="durationSize" style="background-color:{{$timeSheet->event->color}};" title="{{$timeSheet->dateTime}}"></div>
                            @empty
                                &nbsp
                            @endforelse
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach






    </div>


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
