@extends('../adminIndex')

@section('header')
 <form method="GET" action="" class="w-100">
        <div class="row">   
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="fromDate" name="fromDate" value="{{$periodDate->getStartDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <input class="form-control" type="date" id="toDate" name="toDate" value="{{$periodDate->getEndDate()->format('Y-m-d')}}"/>
            </div>
            <div class="col-2 input-group-sm">
                <select id="eventSelect">
                    <option value="0">Событие</option>
                    @foreach($eventsObj as $eventObj)
                        <option value="{{$eventObj->id}}">{{$eventObj->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-1"></div>
            <div class="col-2 input-group-sm form-check">
                <input class="form-check-input" type="checkbox" id="download" name="download" value="1"/>    
                <label class="form-check-label" for="download">Скачать</label>
            </div>
            
            <div class="col-1 input-group-sm">
                <button class="btn btn-sm btn-success" type="submit">Отчет</button>
            </div>
        </div>
    </form>
@endsection



@section('content')
 
    @foreach($carGroups as $carGroup)
        @if(count($carGroup->carsModel))
            <div class="row mt-5">
                <div class="col-2">{{$carGroup->name}}</div>
                <div class="col-10"></div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    @foreach($carGroup->carsModel as $car)
                        <div class="row  border-top mt-3">
                            <div class="col-3">{{$car->nickName}}</div>
                            <div class="col-3">{{$car->filterStartText}} - {{$car->filterFinishText}}</div>
                            <div class="col-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="col-6">
                                @foreach($car->filterTimeSheets as $timeSheet)
                                <div class="row border-top">
                                    <div class="col-2">
                                        {{$timeSheet->event->name}}
                                    </div>
                                    <div class="col-2 text-right">
                                        {{$timeSheet->toPayment->sum}}
                                    </div>
                                    <div class="col-2 text-right">
                                        {{$timeSheet->toPayment->paymentSum}}
                                    </div>
                                    <div class="col-4">
                                        {{$timeSheet->dateText}}
                                    </div>
                                </div>
                                @endforeach
                                 <div class="row border-top">
                                    <div class="col-2">
                                        
                                    </div>
                                    <div class="col-2 text-right">
                                        {{$car->toPay}}
                                    </div>
                                    <div class="col-2 text-right">
                                        {{$car->pay}}
                                    </div>
                                    <div class="col-4">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach

@endsection


@section('js')
  
@endsection


