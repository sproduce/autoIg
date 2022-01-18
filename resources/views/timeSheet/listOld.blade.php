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

        <input type="date" name="currentDate" value="{{$carbon->now()->format('Y-m-d')}}"/>
        <input type="submit" value="Показать"/>
    </div>

</form>
    <div class="row border">
        <div class="col-2 border-right">

        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 7; $i>1; $i--)
                <div class="col-2 border-right text-center">
                    {{$carbon->subDays($i)->isoFormat('ddd')}}
                    <br>
                    <a href="?currentDate={{$carbon->subDays($i)->format('Y-m-d')}}">
                        {{$carbon->subDays($i)->isoFormat('D')}}
                    </a>
                </div>
                @endfor
            </div>
        </div>
        <div class="col-2">
            <div class="row">
                <div class="col-4 border-right text-center">
                    {{$carbon->subDays(1)->isoFormat('ddd')}}
                    <br>
                    {{$carbon->subDays(1)->isoFormat('D')}}
                </div>

                <div class="col-4 border border-bottom-0 border-primary text-center">
                    {{$carbon->isoFormat('ddd')}}
                    <br>
                    {{$carbon->isoFormat('D')}}
                </div>
                <div class="col-4 border-right text-center">
                    {{$carbon->addDays(1)->isoFormat('ddd')}}
                    <br>
                    {{$carbon->addDays(1)->isoFormat('D')}}
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 2; $i < 8; $i++)
                    <div class="col-2 border-right text-center">
                        {{$carbon->addDays($i)->isoFormat('ddd')}}
                        <br>
                        <a href="?currentDate={{$carbon->addDays($i)->format('Y-m-d')}}">
                            {{$carbon->addDays($i)->isoFormat('D')}}
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    @if($motorPool->count())
        @foreach($motorPool as $car)
            <div class="row border carInfo" data-carid="{{$car->id}}">
                <div class="col-2 border-right">

                    {{$car->nickName}}
                    @empty($car->nickName)
                        Noname
                        @endempty
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 7; $i>1; $i--)
                            @php
                                $currentDate=$carbon->subDays($i);
                                $fromDate=$currentDate->format('Y-m-d');
                                $toDate=$currentDate->addDays(1)->format('Y-m-d');
                                $col=$timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->count();
                                if ($col){
                                    $divCol=ceil(12/$col);
                                }

                            @endphp
                            <div class="col-2 border-right timeClickable" data-datetime="{{$fromDate}}">
                                <div class="row">&nbsp</div>
                                <div class="row">
                                    @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                        <div class="col-{{$divCol}} p-1" style="background-color:{{$timeSheet->event->color}}"></div>
                                    @empty
                                        <div class="col-12 p-1"></div>
                                    @endforelse
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                            @php
                                $currentDate=$carbon->subDays(1);
                                $fromDate=$currentDate->format('Y-m-d');
                                $toDate=$currentDate->addDays(1)->format('Y-m-d');
                                $col=$timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->count();
                                if ($col){
                                    $divCol=ceil(12/$col);
                                }
                            @endphp
                        <div class="col-4 border-right timeClickable" data-datetime="{{$fromDate}}">
                            <div class="row">&nbsp</div>
                            <div class="row">
                                @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                    <div class="col-1 p-1" style="background-color:{{$timeSheet->event->color}}"></div>
                                @empty
                                    <div class="col-12 p-1"></div>
                                @endforelse
                            </div>
                        </div>
                        @php
                            $currentDate=$carbon;
                            $fromDate=$currentDate->format('Y-m-d');
                            $toDate=$currentDate->addDays(1)->format('Y-m-d');
                            $col=$timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->count();
                                if ($col){
                                    $divCol=ceil(12/$col);
                                }
                        @endphp
                        <div class="col-4 border-right border-left timeClickable border-primary" data-datetime="{{$fromDate}}">
                            <div class="row">&nbsp</div>
                            <div class="row">
                                @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                    <div class="col-{{$divCol}} p-1" style="background-color:{{$timeSheet->event->color}}"></div>
                                @empty
                                    <div class="col-12 p-1"></div>
                                @endforelse
                            </div>



                        </div>
                        @php
                            $currentDate=$carbon->addDays(1);
                            $fromDate=$currentDate->format('Y-m-d');
                            $toDate=$currentDate->addDays(1)->format('Y-m-d');
                            $col=$timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->count();
                            if ($col){
                                $divCol=ceil(12/$col);
                            }
                        @endphp
                        <div class="col-4 border-right timeClickable" data-datetime="{{$fromDate}}">
                            <div class="row">&nbsp</div>
                            <div class="row">
                                @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                    <div class="col-{{$divCol}} p-1" style="background-color:{{$timeSheet->event->color}}"></div>
                                @empty
                                    <div class="col-12 p-1"></div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 2; $i < 8; $i++)
                            @php
                                $currentDate=$carbon->addDays($i);
                                $fromDate=$currentDate->format('Y-m-d');
                                $toDate=$currentDate->addDays(1)->format('Y-m-d');
                                $col=$timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->count();
                                if ($col){
                                    $divCol=ceil(12/$col);
                                }
                            @endphp
                            <div class="col-2 border-right timeClickable" data-datetime="{{$fromDate}}">
                                <div class="row">&nbsp</div>
                                <div class="row">
                                    @forelse($timeSheets->where('carId',$car->id)->whereBetween('dateTime',[$fromDate,$toDate])->sortBy('dateTime') as $timeSheet)
                                        <div class="col-{{$divCol}} p-1" style="background-color:{{$timeSheet->event->color}}"></div>
                                    @empty
                                        <div class="col-12 p-1"></div>
                                    @endforelse
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>



        @endforeach
    @endif




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
