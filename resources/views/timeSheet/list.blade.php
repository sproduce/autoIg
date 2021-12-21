@extends('../adminIndex')

@php

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
            <div class="row border carInfo" data-carId="{{$car->id}}">
                <div class="col-2 border-right">
                    !{{$car->nickName}}
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 7; $i>1; $i--)
                            <div class="col-2 border-right timeClickable">
                                @if ($car->timeSheet($carbon::now()->subDays($i))->count())
                                @else
                                    &nbsp;
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-4 border-right timeClickable">
                            @if ($car->timeSheet($carbon::now()->subDays(1))->count())
                                @foreach($car->timeSheet($carbon::now()->subDays(1)) as $event)
                                    {{$event->carId}}
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                        </div>

                        <div class="col-4 border-right timeClickable">
                            @if ($car->timeSheet($carbon::now())->count())
                            @else
                                &nbsp;
                            @endif
                        </div>
                        <div class="col-4 border-right timeClickable">
                            @if ($car->timeSheet($carbon::now()->addDays(1))->count())
                            @else
                                &nbsp;
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 2; $i < 8; $i++)
                            <div class="col-2 border-right timeClickable">
                                @if ($car->timeSheet($carbon::now()->addDays($i))->count())
                                @else
                                    &nbsp;
                                @endif
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
$(".timeClickable").dblclick(function() {
    DialogUserMin('/timesheet/add');
    console.log($(this).parent(".carInfo").attr("data-carId"));
});
</script>
@endsection
