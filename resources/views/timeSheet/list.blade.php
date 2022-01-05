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

    <div class="row border">
        <div class="col-2 border-right">

        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 7; $i>1; $i--)
                <div class="col-2 border-right text-center">
                    {{$carbon::now()->subDays($i)->format('D')}}
                    <br>
                    {{$carbon::now()->subDays($i)->format('d')}}
                </div>
                @endfor
            </div>
        </div>
        <div class="col-2">
            <div class="row">
                <div class="col-4 border-right text-center">
                    {{$carbon::now()->subDays(1)->format('D')}}
                    <br>
                    {{$carbon::now()->subDays(1)->format('d')}}
                </div>

                <div class="col-4 border-right text-center">
                    {{$carbon::now()->format('D')}}
                    <br>
                    {{$carbon::now()->format('d')}}
                </div>
                <div class="col-4 border-right text-center">
                    {{$carbon::now()->addDays(1)->format('D')}}
                    <br>
                    {{$carbon::now()->addDays(1)->format('d')}}
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 2; $i < 8; $i++)
                    <div class="col-2 border-right text-center">
                        {{$carbon::now()->addDays($i)->format('D')}}
                        <br>
                        {{$carbon::now()->addDays($i)->format('d')}}
                    </div>
                @endfor
            </div>
        </div>
    </div>

    @if($motorPool->count())
        @foreach($motorPool as $car)
            <div class="row border carInfo" data-carid="{{$car->id}}">
                <div class="col-2 border-right">
                    !{{$car->nickName}}
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 7; $i>1; $i--)
                            @php
                                $currentDate=$carbon::now()->subDays($i);
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
                                $currentDate=$carbon::now()->subDays(1);
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
                            $currentDate=$carbon::now();
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
                        @php
                            $currentDate=$carbon::now()->addDays(1);
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
                                $currentDate=$carbon::now()->addDays($i);
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
            DialogUser('/timesheet/add?carId='+carId+'&date='+dateTime);
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
