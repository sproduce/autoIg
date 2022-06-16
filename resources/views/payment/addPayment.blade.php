@extends('../adminIndex')


@section('header')
    <h6 class="modal-title w-100 font-weight-bold">Добавить платеж</h6>

@endsection

@php
    $accounts=$paymentGuide->get('accounts');
    $operationTypes=$paymentGuide->get('operationTypes');
@endphp

@section('content')
    <form method="POST" action="/payment/add">
        @if ($paymentObj->id)
            <input type="number" name="id" id="id" value="{{$paymentObj->id}}" hidden/>
        @endif
        @csrf

        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3"><input type="datetime-local" name="dateTime" value="{{old('dateTime',$paymentObj->dateTime ? $paymentObj->dateTime->format('Y-m-d\TH:i:s'):'')}}" id="dateTime" required/> <button class="btn btn-ssm btn-outline-success" title="Текущая дата" id="currentDate"><i class="fas fa-calendar-alt"></i></button> </div>
            <div class="col-1">Сумма</div>
            <div class="col-3"><input type="number" name="payment" value="{{old('payment',$paymentObj->payment)}}" required/></div>
            <div class="col-1">Комиссия</div>
            <div class="col-3"><input type="number" name="comm" value="{{old('comm',$paymentObj->comm)}}"/></div>
        </div>

        <div class="row">
            <div class="col-3">
                @foreach($accounts as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountId" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-2 border-right">
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
                            <input type="radio"  name="payOperationTypeId" value="" required/>
                                Не указано
                        </div>
                    </div>
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-3">
                       Субьект
                    </div>
                    <div class="col-1">
                        <a href="/subject/addSubjectTo/subject" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
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
                    <div class="col-3">
                        Машина
                    </div>
                    <div class="col-1">
                        <a href="/payment/addCar" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
                        <input id="carText" name="carText" value="{{old('carText',$paymentObj->car->nickName)}}" disabled />
                        <input name="carId" id="carId" value="{{old('carId',$paymentObj->carId)}}"  hidden />
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        Группа
                    </div>
                    <div class="col-1">
                        <a href="/carGroup/searchDialog" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
                        <input id="carGroupText" name="carGroupText" value="{{old('carGroupText',$paymentObj->carGroup->nickName)}}" disabled />
                        <input name="carGroupId" id="carGroupId" value="{{old('carGroupId',$paymentObj->carGroupId)}}"  hidden />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        Договор
                    </div>
                    <div class="col-1">
                        <a href="/payment/addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
                        <input id="contractText" name="contractText" value="{{old('contractText',$paymentObj->contract->number)}}" disabled />
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
        <div class="row mt-3 pt-3">
            <div class="col-4">
                <input type="submit" class="btn btn-primary" value="Добавить">
            </div>
            <div class="col-4">
                <input type="submit" class="btn btn-primary" value="Добавить следующий">
            </div>
        </div>
    </form>


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
