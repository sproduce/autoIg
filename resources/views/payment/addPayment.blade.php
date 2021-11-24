@extends('../adminIndex')


@section('header')
    <h6 class="modal-title w-100 font-weight-bold">Добавить платеж</h6>

@endsection

@php
    $accounts=$paymentGuide->get('accounts');
    $operationTypes=$paymentGuide->get('operationTypes');
    if($accounts->count()>=$operationTypes->count()){
        $colLine=$accounts->count();
        }
        else{
            $colLine=$operationTypes->count();
        }

@endphp

@section('content')
    <form method="POST" action="/payment/add">
        @csrf
        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3"><input type="datetime-local" name="dateTime"/></div>
            <div class="col-1">Сумма</div>
            <div class="col-3"><input type="number" name="payment" required/></div>
            <div class="col-1">Комиссия</div>
            <div class="col-3"><input type="number" value="0" name="comm"/></div>
        </div>


        @for($step=0;$step<$colLine;$step++)
            <div class="row">
                <div class="col-3 @isset($accounts[$step]->nickName)clickable @endisset">
                    @isset($accounts[$step]->nickName)
                        <input type="radio"  name="payAccountId" value="{{$accounts[$step]->id}}" required>
                        {{$accounts[$step]->nickName}}
                    @endisset
                </div>
                <div class="col-3 @isset($operationTypes[$step]->name)clickable  @endisset">
                    @isset($operationTypes[$step]->name)
                        <input type="radio"  name="payOperationTypeId" value="{{$operationTypes[$step]->id}}" required>
                        {{$operationTypes[$step]->name}}
                    @endisset

                </div>

            </div>
        @endfor

        <div class="row pt-3 mt-3 border-top">
            <div class="col-2">
                Комментарий
            </div>
            <div class="col-10">
                <input type="text" name="name"/>
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
</script>

@endsection
