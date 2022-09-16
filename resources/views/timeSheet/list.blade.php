@extends('../adminIndex')


@section('header')
    <h6 class="m-0 mr-3">Табель</h6><br/>
@endsection


@section('content')

    <form type="GET" action="" id="filterForm">
        <div class="form-row text-center">
            <div class="form-group col-md-1 input-group-sm">
                <input type="number" class="form-control" name="subDays" value="{{$subDays}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm text-right">
                <div class="btn btn-outline-primary btn-ssm changeDate">-30</div>
                <div class="btn btn-outline-primary btn-ssm ml-3 mr-3 changeDate">-14</div>
                <div class="btn btn-outline-primary btn-ssm changeDate">-7</div>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input type="date"  id="currentDate" class="form-control" name="currentDate" value="{{$currentDate->format('Y-m-d')}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm text-left">
                <div class="btn btn-outline-primary btn-ssm changeDate">+7</div>
                <div class="btn btn-outline-primary btn-ssm ml-3 mr-3 changeDate">+14</div>
                <div class="btn btn-outline-primary btn-ssm changeDate">+30</div>
            </div>
            <div class="form-group col-md-1 input-group-sm">
                <input type="number" class="form-control" name="addDays" value="{{$addDays}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <select name="carGroupId" class="form-control">
                    <option value="0">Выбрать группу</option>
                    @foreach($carGroupObj as $carGroup)
                        <option value="{{$carGroup->id}}" @if($carGroup->id==$carGroupId) selected @endif>{{$carGroup->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <input type="submit" class="btn btn-sm btn-primary" value="Показать"/>
            </div>
        </div>

    </form>



    <div class="container-fluid overflow-auto" id="scrollTimeSheet">

{{--        <div class="row flex-nowrap">--}}
{{--            <div class="p-0 text-center carInfoSize border"><div class="p-0">1</div></div>--}}
{{--            @foreach($periodDate as $date)--}}
{{--                <div class="daySize4h p-0 text-center border"></div>--}}
{{--            @endforeach--}}
{{--        </div>--}}

        <div class="row flex-nowrap">
            <div class="col p-0 text-center border carInfoSize">
                <div class="p-0">#</div>
            </div>
            @foreach($periodDate as $date)
                @if($date == $currentDate)
                    <div class="col daySize4h p-0 text-center border bg-primary">
                        <div class="p-0">{{$date->isoFormat('ddd')}}<br/> {{$date->format('d/m/y')}}</div>
                    </div>
                @else
                    <div class="col daySize4h p-0 text-center border">
                        <div class="p-0">{{$date->isoFormat('ddd')}}<br/>
{{--                            <a href="/timesheet/days">{{$date->isoFormat('D')}}</a>--}}
                            {{$date->format('d/m/y')}}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>


        @foreach($motorPoolObj as $car)
            <div class="row flex-nowrap carInfo" data-carid="{{$car->id}}">
                <div class="col p-0 text-left border carInfoSize">
                    <div class="p-0">
                        {{$car->nickName}}
{{--                        <a href="/timesheet/car?carId={{$car->id}}">{{$car->nickName}}</a>--}}
                    </div>
                </div>
                @for($i=0;$i<$periodDate->count();$i++)
                    <div class="col p-0 daySize4h border timeClickable @if (!$periodDate->getStartDate()->addDays($i)->between($car->dateStart,$car->dateFinish)) bg-secondary @endif " data-datetime="{{$periodDate->getStartDate()->addDays($i)->format('Y-m-d')}}">
                        @if(isset($timeSheetArray[$car->id]))
                            @forelse($timeSheetArray[$car->id] as $timeSheet)
                                <div class="p-0 row m-0">
                                    @for($j=1;$j<=6;$j++)
                                        @if(isset($timeSheet[$i*6+$j]['data']))
                                            <div class="durationSize @if($timeSheet[$i*6+$j]['first']) rounded-left @endif @if($timeSheet[$i*6+$j]['last']) rounded-right @endif" data-id="{{$timeSheet[$i*6+$j]['data']->dataId}}" data-datestart="{{$timeSheet[$i*6+$j]['data']->dateTime}}" title="{{$timeSheet[$i*6+$j]['data']->eventName}}" style="background-color:{{$timeSheet[$i*6+$j]['data']->eventColor}};" ></div>
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
            console.log($(".daySize4h").width()*4);
        });

        $(".timeClickable").dblclick(function(e) {
            var carId=$(this).closest('.carInfo').data('carid');
            var dateTime=$(this).data('datetime');
            switch(true){
                case e.ctrlKey:
                    $(location).prop('href','/timesheet/add?carId='+carId+'&date='+dateTime);
                    break;
                case e.altKey:
                    $(location).prop('href','/timesheet/car?carId='+carId+'&fromDate='+dateTime+'&toDate='+dateTime);
                    break;
                default:
                    DialogUser('/timesheet/info?carId='+carId+'&date='+dateTime);
            }
        });

        $(".changeDate").click(function(){
            var currentDate = new Date($('#currentDate').val()), kolday=parseInt($(this).text());
            currentDate.setDate(currentDate.getDate()+kolday);
            $("#currentDate").val(currentDate.toISOString().split('T')[0]);
            $('#filterForm').submit();
        });



    </script>
@endsection
