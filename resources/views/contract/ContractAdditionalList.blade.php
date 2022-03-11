@extends('../adminIndex')

@php

@endphp
@section('header')
     <h6 class="m-0 mr-3">Услуги по Договорам</h6>
     <form type="GET" action="" id="filterForm">
         <div class="d-flex flex-row">
             <div class="p-2 input-group-sm">
                 <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
             </div>
             <div class="p-2 input-group-sm">
                 <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
             </div>
             <div class="p-2 input-group-sm">
                 <input class="btn btn-sm btn-primary" value="Показать" type="submit"/>
             </div>
         </div>
     </form>
@endsection


@section('content')


@endsection


@section('js')

@endsection


