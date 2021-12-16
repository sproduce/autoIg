@extends('../adminIndex')

@php

@endphp
@section('header')

            <h6 class="m-0 mr-3">Табель</h6>


@endsection


@section('content')

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 0; $i < 6; $i++)
                <div class="col-2">
                    {{$currentDate->addDays(1)->format('D')}}<br/>
                    {{$currentDate->format('d')}}
                </div>
                @endfor
            </div>
        </div>
        <div class="col-2">
            <div class="row border">
                <div class="col-4">
                    {{$currentDate->addDays(1)->format('D')}}<br/>
                    {{$currentDate->format('d')}}
                </div>

                <div class="col-4">
                    {{$currentDate->addDays(1)->format('D')}}<br/>
                    {{$currentDate->format('d')}}
                </div>
                <div class="col-4">
                    {{$currentDate->addDays(1)->format('D')}}<br/>
                    {{$currentDate->format('d')}}
                </div>

            </div>
        </div>
        <div class="col-4">
            <div class="row">
                @for ($i = 0; $i < 6; $i++)
                    <div class="col-2">
                        {{$currentDate->addDays(1)->format('D')}} <br/>
                        {{$currentDate->format('d')}}
                    </div>
                @endfor
            </div>
        </div>
    </div>




@endsection


@section('js')


@endsection
