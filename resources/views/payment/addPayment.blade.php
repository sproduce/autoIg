@extends('../adminIndex')


@section('header')
    <h6 class="modal-title w-100 font-weight-bold">Добавить платеж</h6>

@endsection

@php
    $accounts = $paymentGuide->get('accounts');
    $operationTypes = $paymentGuide->get('operationTypes');
@endphp

@section('content')

    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active">Платеж</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/payment/addBetweenAccounts">Между счетами</a>
                </li>
            </ul>
        </div>
        <div class="card-body">



    <form method="POST" action="/payment/add" id="paymentForm">
        @if ($paymentObj->id)
            <input type="number" name="id" id="id" value="{{$paymentObj->id}}" hidden/>
        @endif
        @csrf

        <div class="row mb-2">
            <div class="col-5"></div>
            <div class="col-3">
                <button id="inboundbtn" class="btn btn-ssm btn-outline-danger mr-4 text"><strong>Приход</strong></button>
                <button id="outboundbtn" class="btn btn-ssm btn-outline-secondary ml-4">Расход</button>
            </div>
        </div>
            
        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3">
                <input type="datetime-local" name="dateTime" value="{{old('dateTime',$paymentObj->dateTime ? $paymentObj->dateTime->format('Y-m-d\TH:i:s'):'')}}" id="dateTime" required/>
                <button class="btn btn-ssm btn-outline-success" title="Текущая дата" id="currentDate"><i class="fas fa-calendar-alt"></i></button>
            </div>
            <div class="col-1">Сумма</div>
            <div class="col-3">
                <span id="sign" class="text-secondary mr-2"><i class="fas fa-minus"></i></span>
                
                <input id="inputSum" @if ($paymentObj->payment>=0)data-type="1" @else data-type="-1" @endif" type="number" value="{{old('payment',$paymentObj->payment)?abs(old('payment',$paymentObj->payment)):''}}" required/>
                <input id="sum" type="number" name="payment" required hidden/>
            </div>
            <div class="col-1">Комиссия</div>
            <div class="col-3"><input type="number" name="comm" value="{{old('comm',$paymentObj->comm)}}"/></div>
        </div>

        <div class="row">
            <div class="col-3 text-left">
                @foreach($accounts as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountId" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-2 border-right text-left">
                @foreach($operationTypes as $operationType)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payOperationTypeId" @if (old('payOperationTypeId',$paymentObj->payOperationTypeId) == $operationType->id) checked @endif value="{{$operationType->id}}" required>
                            {{$operationType->name}}
                        </div>
                    </div>
                @endforeach
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payOperationTypeId" value="0" @if(old('payOperationTypeId') === 0 || !$paymentObj->payOperationTypeId) checked @endif required/>
                                Не указано
                        </div>
                    </div>
            </div>
            <div class="col-3">
                <div class="row clearRow">
                    <div class="col-3 p-0">
                       Субьект
                    </div>
                    <div class="col-1 p-0">
                        <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-1 p-0">
                        <a class="btn btn-ssm btn-outline-danger clearButton"><i class="fas fa-eraser"></i></a>
                    </div>
                    <div class="col-7 p-0">
                        <input id="subjectText" name="subjectText" value="{{old('subjectText',$paymentObj->subject->nickname)}}" readonly/>
                        <input name="subjectId" id="subjectId" value="{{old('subjectId',$paymentObj->subjectId)}}"  hidden />
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        Имя
                    </div>
                    <div class="col-9">
                        <input type="text" name="name" id="name" value="{{old('name',$paymentObj->name)}}"/>
                    </div>
                </div>


            </div>
            <div class="col-3">
                <div class="row clearRow">
                    <div class="col-3 p-0">
                        Машина
                    </div>
                    <div class="col-1 p-0">
                        <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success DialogUser"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-1 p-0">
                        <a class="btn btn-ssm btn-outline-danger clearButton"><i class="fas fa-eraser"></i></a>
                    </div>
                    <div class="col-7 p-0">
                        <input id="carText" name="carText" value="{{old('carText',$paymentObj->car->nickName)}}" readonly/>
                        <input name="carId" id="carId" value="{{old('carId',$paymentObj->carId)}}"  hidden />
                    </div>
                </div>

                <div class="row clearRow">
                    <div class="col-3 p-0">
                        Группа
                    </div>
                    <div class="col-1 p-0">
                        <a href="/carGroup/addCarGroupTo" class="btn btn-ssm btn-outline-success DialogUser"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-1 p-0">
                        <a class="btn btn-ssm btn-outline-danger clearButton"><i class="fas fa-eraser"></i></a>
                    </div>
                    <div class="col-7 p-0">
                        <input id="carGroupText" name="carGroupText" value="{{old('carGroupText',$paymentObj->carGroup->nickName)}}" readonly/>
                        <input name="carGroupId" id="carGroupId" value="{{old('carGroupId',$paymentObj->carGroupId)}}"  hidden />
                    </div>
                </div>
                <div class="row clearRow">
                    <div class="col-3 p-0">
                        Договор
                    </div>
                    <div class="col-1 p-0">
                        <a href="/contract/addContractTo" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-1 p-0">
                        <a class="btn btn-ssm btn-outline-danger clearButton"><i class="fas fa-eraser"></i></a>
                    </div>
                    <div class="col-7 p-0">
                        <input id="contractText" name="contractText" value="{{old('contractText',$paymentObj->contract->number)}}" readonly/>
                        <input name="contractId" id="contractId" value="{{old('contractId',$paymentObj->contractId)}}"  hidden />
                    </div>
                </div>
            </div>
        </div>

        <div class="row pt-3">
            <div class="col-2">

            </div>
            <div class="col-5 pt-1">


            </div>

        </div>

        <div class="row mt-3">
            <div class="col-2">
                Комментарий
            </div>
            <div class="col-10">
                <input type="text" class="col-6" name="comment" value="{{old('comment',$paymentObj->comment)}}"/>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-2">
                Платеж завершен
            </div>
            <div class="col-10">
                <input type="checkbox" value="1"  name="finished" @if(old('finished',$paymentObj->finished)) checked @endif/>
            </div>
        </div>
        <div class="row mt-3">
            @if ($paymentObj->id)
                <div class="col-4"></div>
                <div class="col-4">
                    <input type="submit" class="btn btn-primary" value="Сохранить">
                </div>
            @else
                <input type="text" id="redirectPath" name="redirectPath" hidden/>
                <div class="col-2"></div>
                <div class="col-10">
                    <button class="btnSubmit btn btn-ssm btn-primary" data-redirect="save">Сохранить</button>
                    <button class="btnSubmit btn btn-ssm btn-primary" data-redirect="allocate">Сохранить и распределить</button>
                    <button class="btnSubmit btn btn-ssm btn-success" data-redirect="empty">Сохранить и создать пустой</button>
                    <button class="btnSubmit btn btn-ssm btn-success" data-redirect="replicate">Сохранить и создать такой же</button>
                    <button class="btn btn-ssm btn-danger clearForm">Отменить</button>
                </div>
            @endif
            
        </div>
    </form>
        </div>

@endsection



@section('js')

<script>
    $(".clickable").click(function(){
        $(this).children().prop("checked", true);
    });
    $("#currentDate").click(function(){
        currentDate = new Date();
        currentDate.setHours(currentDate.getHours()+ (currentDate.getTimezoneOffset()/-60));
        $("#dateTime").val(currentDate.toJSON().slice(0,16));
        return false;
    });

    $(".btnSubmit").click(function(e){
        $("#redirectPath").val($(this).data('redirect'));

    });



    function inbound(){
        $('#inboundbtn').removeClass('btn-outline-secondary');
        $('#outboundbtn').removeClass('btn-outline-danger');
        $('#outboundbtn').addClass('btn-outline-secondary');
        $('#inboundbtn').addClass('btn-outline-danger');
        $('#sign').removeClass('text-danger');
        $('#sign').addClass('text-secondary');
        
    }


    function outbound(){
        $('#outboundbtn').removeClass('btn-outline-secondary');
        $('#inboundbtn').removeClass('btn-outline-danger');
        $('#inboundbtn').addClass('btn-outline-secondary');
        
        $('#outboundbtn').addClass('btn-outline-danger');
        $('#sign').removeClass('text-secondary');
        $('#sign').addClass('text-danger');
    }



    $('#inputSum').keypress(function(e){
        if (e.keyCode==45){
            $('#inputSum').data('type',$('#inputSum').data('type')*-1);
            return false;
        }
    });

    function updateSum(){
        $('#sum').val( $('#inputSum').val()*$('#inputSum').data('type'));
        if ($('#inputSum').data('type')>0){
                inbound();
            }else {
                outbound();
            }
    }


    $('#inputSum').keyup(function(e){
        updateSum();
    });


    $("#inboundbtn").click(function(){
        inbound();
        $('#inputSum').data('type',1);
        updateSum();
        return false;
    });
        
    $("#outboundbtn").click(function(){
        outbound();
        $('#inputSum').data('type',-1);
        updateSum();
        return false;
    });
        updateSum();
</script>

@endsection
