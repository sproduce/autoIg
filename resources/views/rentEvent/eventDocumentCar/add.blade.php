@extends( ($needParent) ? '../adminIndex' : '../cleanIndex')

@if($needParent)
    @section('header')
        <h6 class="modal-title w-100 font-weight-bold text-center">Событие {{$eventObj->name}}</h6>
    @endsection
@endif

@section('content')
    <form method="POST" action="/rentEvent/{{$eventObj->id}}" enctype="multipart/form-data">
        @csrf
        <input type="number" name="id" id="id" value="{{old('id',$eventDataObj->id)}}" hidden/>
        <input type="number" name="parentId" id="parentId" value="{{old('parentId',$parentId ?? $eventDataObj->parentId)}}" hidden/>
        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="carText" title="Автомобиль">Машина</label>
                <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser ml-2"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton"><i class="fas fa-eraser"></i></a>
                <input id="carText" class="form-control" value="{{old('carText',$eventDataObj->carText ?? $carObj->nickName)}}" readonly />
                <input id="carId" name="carId" class="form-control" value="{{old('carId',$eventDataObj->carId ?? $carObj->id)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="subjectText" title="Оформлял субьект">Оформлял субьект</label>
                <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton" id="subjectClear"><i class="fas fa-eraser"></i></a>
                <input id="subjectText" name="subjectText" value="{{old('subjectText',$eventDataObj->subjectNickname)}}" class="form-control"  readonly/>
                <input name="subjectId" id="subjectId" value="{{old('subjectId',$eventDataObj->subjectId)}}" hidden/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="date" title="Дата события">Дата события</label>
                <input type="date" name="date" id="date" class="form-control" value="{{old('date',$eventDataObj->date ? $eventDataObj->date->toDateString() : $dateTime->toDateString())}}" required/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="dateDocument" title="Дата выдачи">Дата выдачи</label>
                <input type="date" name="dateDocument" id="dateDocument" class="form-control" value="{{old('dateDocument',$eventDataObj->dateDocument ? $eventDataObj->dateDocument->toDateString() : '')}}" required/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="sum" title="Сумма">Сумма</label>
                <input type="number" name="sum" id="sum" value="{{old('sum',$eventDataObj->sum)}}" class="form-control"/>
            </div>
        </div>

        <div class="form-row text-center">
            <div class="form-group col-md-3 input-group-sm clearRow">
                <label for="subjectToText" title="Оформлено на">Оформлено на</label>
                <a href="/subject/addSubjectTo/subjectTo" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                <a class="btn btn-ssm btn-outline-danger ml-2 clearButton" id="subjectClear"><i class="fas fa-eraser"></i></a>
                <input id="subjectToText" name="subjectToText" value="{{old('subjectText',$eventDataObj->subjectToNickname)}}" class="form-control" readonly/>
                <input name="subjectToId" id="subjectToId" value="{{old('subjectId',$eventDataObj->subjectToId)}}" hidden/>
            </div>
            <div class="form-group col-md-3 input-group-sm">
                <label for="number" title="Номер">Номер</label>
                <input type="text" name="number" id="number" class="form-control" value="{{old('sum',$eventDataObj->number)}}"/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <label for="expiration" title="Действительно до">Действительно до</label>
                <input type="date" name="expiration" id="expiration" class="form-control" value="{{old('expiration',$eventDataObj->expiration ? $eventDataObj->expiration->toDateString() : '')}}" required/>
            </div>
            <div class="form-group col-md-2 input-group-sm">
                <div class="form-row">
                    <div class="form-group col-md-3 input-group-sm">
                        <label>&nbsp</label>
                        <div class="btn btn-outline-primary btn-ssm form-control addPeriod" data-month="3">+3</div>
                    </div>
                    <div class="form-group col-md-3 input-group-sm">
                        <label>&nbsp</label>
                        <div class="btn btn-outline-primary btn-ssm form-control addPeriod" data-month="6">+6</div>
                    </div>
                    <div class="form-group col-md-3 input-group-sm">
                        <label>&nbsp</label>
                        <div class="btn btn-outline-primary btn-ssm form-control addPeriod" data-month="12">+12</div>
                    </div>
                    <div class="form-group col-md-3 input-group-sm">
                        <label>&nbsp</label>
                        <div class="btn btn-outline-primary btn-ssm form-control addPeriod" data-month="24">+24</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-row text-center">
            <div class="form-group col-md-6 input-group-sm">
                <label for="marks" title="Особые отметки">Особые отметки</label>
                <input type="text" name="marks" id="marks" value="{{old('marks',$eventDataObj->marks)}}" class="form-control"/>
            </div>
            <div class="form-group col-md-6 input-group-sm">
                <label for="comment" title="Комменатрий">Комменатрий</label>
                <input type="text" name="comment" id="comment" value="{{old('comment',$eventDataObj->comment)}}" class="form-control"/>
            </div>
        </div>
        
        
        @include("rentEvent.fileAdd")

        <div class="form-row text-center" id="last-row">
            @if ($eventDataObj->id)
            <div class="input-group col-1">
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Сохранить"/>
            </div>
            @else
                @include("rentEvent.buttonSubmit")
            @endif
        </div>
    </form>
@endsection

        
        
@section('js')
    <script>
         $("#date").focusout(function(){
            $("#dateDocument").val($("#date").val());
         });
             
            $(".addPeriod").click(function(){
            dateDocument = new Date($("#dateDocument").val());
            dateDocument.setMonth(dateDocument.getMonth()+$(this).data('month'));
            
            console.log(dateDocument.toISOString().substring(0,10));
            $("#expiration").val(dateDocument.toISOString().substring(0,10));
              //alert($(this).data('month'));
             });
    </script>
@endsection