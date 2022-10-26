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



    <form method="POST" action="/payment/add">
        @if ($paymentObj->id)
            <input type="number" name="id" id="id" value="{{$paymentObj->id}}" hidden/>
        @endif
        @csrf

        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3">
                <input type="datetime-local" name="dateTime" value="{{old('dateTime',$paymentObj->dateTime ? $paymentObj->dateTime->format('Y-m-d\TH:i:s'):'')}}" id="dateTime" required/>
                <button class="btn btn-ssm btn-outline-success" title="Текущая дата" id="currentDate"><i class="fas fa-calendar-alt"></i></button>
            </div>
            <div class="col-1">Сумма</div>
            <div class="col-3"><input type="number" name="payment" value="{{old('payment',$paymentObj->payment)}}" required/></div>
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
                <div class="row">
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
                <div class="row">
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

                <div class="row">
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
                <div class="row">
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
        <div class="row">
            @if ($paymentObj->id)
                <div class="col-4"></div>
            @else
                <div class="col-2">Следующий платеж</div>
                <div class="col-2"><input type="checkbox" name="isNext" value="1" @if(old('isNext'))checked @endif/></div>
            @endif
            <div class="col-4">
                <input type="submit" class="btn btn-primary" value="Сохранить">
            </div>
        </div>
    </form>
        </div>>

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


</script>

@endsection
