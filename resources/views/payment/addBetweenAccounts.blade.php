@extends('../adminIndex')


@section('header')
    <h6 class="modal-title w-100 font-weight-bold">Перевод между счетами</h6>

@endsection

@php
//    $accounts=$paymentGuide->get('accounts');

@endphp

@section('content')
    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/payment/add">Платеж</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  active">Между счетами</a>
                </li>
            </ul>
        </div>
        <div class="card-body">

    <form method="POST" action="/payment/storeBetweenAccounts">
        @if ($paymentObj->id)
            <input type="number" name="id" id="id" value="{{$paymentObj->id}}" hidden/>
        @endif
        @csrf
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-1 input-group-sm">
                    <label for="currentDate" title="Дата">Дата</label>
                    <button class="btn btn-ssm btn-outline-success form-control" title="Текущая дата" id="currentDate"><i class="fas fa-calendar-alt"></i></button>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="dateTime" title="Дата">Дата</label>
                    <input type="datetime-local" name="dateTime" class="form-control" value="{{old('dateTime',$paymentObj->dateTime ? $paymentObj->dateTime->format('Y-m-d\TH:i:s'):'')}}" id="dateTime" required/>

                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="payment" title="Сумма">Сумма</label>
                    <input type="number" name="payment" id="payment" class="form-control" value="{{old('payment')}}" autocomplete="off" required />
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="commFrom" title="Комиссия откуда">Комиссия откуда</label>
                    <input type="number" name="commFrom" id="commFrom" class="form-control" value="{{old('commFrom')}}" autocomplete="off"/>
                </div>
                <div class="form-group col-md-2 input-group-sm">
                    <label for="commTo" title="Комиссия куда">Комиссия куда</label>
                    <input type="number" name="commTo" id="commTo" class="form-control" value="{{old('commTo')}}" autocomplete="off"/>
                </div>
            </div>


        <div class="row align-items-center font-weight-bold border mt-3 pb-1">
            <div class="col-3">Откуда</div>
            <div class="col-3">Куда</div>
        </div>

        <div class="row">
            <div class="col-3 text-left">
                @foreach($paymentAccountsObj as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountIdFrom" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3 text-left">
                @foreach($paymentAccountsObj as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountIdTo" @if (old('payAccountId',$paymentObj->payAccountId) ==$account->id) checked @endif value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-4">
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
                    <input id="carGroupText" name="carGroupText" value="{{old('carGroupText')}}" readonly/>
                    <input name="carGroupId" id="carGroupId" value="{{old('carGroupId')}}"  hidden />
                </div>
            </div>
            </div>
        </div>

        <div class="form-row text-center mt-3">
            <div class="form-group col-md-8 input-group-sm">
                <label for="comment" title="Комментарий">Комментарий</label>
                <input type="text" name="comment" id="comment" class="form-control" value="{{old('comment',$paymentObj->comment)}}"/>
            </div>
            <div class="form-group col-md-1 input-group-sm">
            </div>
            <div class="form-group col-md-1 input-group-sm">
                <label for="save" title="">&nbsp</label>
                <input id="save" type="submit" class="btn-ssm btn-primary" value="Сохранить">
            </div>
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


    </script>
@endsection
