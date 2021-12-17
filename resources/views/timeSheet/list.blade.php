@extends('../adminIndex')

@php

@endphp
@section('header')

            <h6 class="m-0 mr-3">Табель</h6>


@endsection


@section('content')

@php


@endphp

    <div class="row">
        <div class="col-2">
            {{$carbon::now()->format('D')}}
        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 7; $i>1; $i--)
                <div class="col-2">
                    {{$carbon::now()->subDays($i)->format('D')}}
                </div>
                @endfor
            </div>
        </div>
        <div class="col-2">
            <div class="row border">
                <div class="col-4">
                    {{$carbon::now()->subDays(1)->format('D')}}
                </div>

                <div class="col-4">
                    {{$carbon::now()->format('D')}}
                </div>
                <div class="col-4">
                    {{$carbon::now()->addDays(1)->format('D')}}
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 2; $i < 8; $i++)
                    <div class="col-2">
                        {{$carbon::now()->addDays($i)->format('D')}}
                    </div>
                @endfor
            </div>
        </div>
    </div>

    @if($motorPool->count())
        @foreach($motorPool as $car)
            <div class="row">
                <div class="col-2">
                    !{{$car->nickName}}
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 7; $i>1; $i--)
                            <div class="col-2">
                                @if ($car->timeSheet($carbon::now()->subDays($i))->count())
                                    qwqw
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
                <div class="col-2">
                    <div class="row border">
                        <div class="col-4">
                            @if ($car->timeSheet($carbon::now()->subDays(1))->count())
                                @foreach($car->timeSheet($carbon::now()->subDays(1)) as $event)
                                    {{$event->carId}}
                                @endforeach
                            @endif
                        </div>

                        <div class="col-4">
                            @if ($car->timeSheet($carbon::now())->count())
                                asdsa
                            @endif
                        </div>
                        <div class="col-4">
                            @if ($car->timeSheet($carbon::now()->addDays(1))->count())
                                asdsa
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        @for ($i = 2; $i < 8; $i++)
                            <div class="col-2">
                                @if ($car->timeSheet($carbon::now()->addDays($i))->count())
                                    asdsa
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


@endsection
