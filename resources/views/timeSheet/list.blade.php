@extends('../adminIndex')


@section('header')

    <h6 class="m-0 mr-3">Табель</h6><br/>



@endsection


@section('content')

    <form type="GET" action="">
        <div class="form-row text-center">
            <div class="form-group col-md-2 input-group-sm">
                <input type="date"  class="form-control" name="currentDate" value="{{$currentDate->format('Y-m-d')}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input type="submit" class="btn btn-sm btn-primary" value="Показать"/>
            </div>
        </div>

    </form>



    <div class="container-fluid overflow-auto" id="scrollTimeSheet">

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


        @foreach($motorPoolObj as $car)
            <div class="row flex-nowrap carInfo" data-carid="{{$car->id}}">
                <div class="col p-0 text-left border carInfoSize">
                    <div class="p-0">{{$car->nickName}}</div>
                </div>
                @for($i=0;$i<21;$i++)
                    <div class="col p-0 daySize border timeClickable" data-datetime="{{$periodDate->getStartDate()->addDays($i)->format('Y-m-d')}}">
                        @if(isset($timeSheetArray[$car->id]))
                            @forelse($timeSheetArray[$car->id] as $timeSheet)
                                <div class="p-0 row m-0">
                                    @for($j=1;$j<=6;$j++)
                                        @if(isset($timeSheet[$i*6+$j]))
                                            <div class="durationSize" data-datestart="{{$timeSheet[$i*6+$j]->dateTime}}" title="{{$timeSheet[$i*6+$j]->name}}" style="background-color:{{$timeSheet[$i*6+$j]->color}};" ></div>
                                        @else
                                            <div class="durationSize"></div>
                                        @endif
                                    @endfor
                                </div>
                            @empty
                            @endforelse
                        @endif
                    </div>
                @endfor
            </div>
        @endforeach






    </div>


@endsection


@section('js')
    <script>
        $(function() {

        });

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
