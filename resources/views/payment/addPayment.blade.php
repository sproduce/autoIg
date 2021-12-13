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
        @csrf

        <div class="row pb-3 mb-3 border-bottom">
            <div class="col-1">Дата</div>
            <div class="col-3"><input type="datetime-local" name="dateTime"/></div>
            <div class="col-1">Сумма</div>
            <div class="col-3"><input type="number" name="payment" required/></div>
            <div class="col-1">Комиссия</div>
            <div class="col-3"><input type="number" value="0" name="comm"/></div>
        </div>

        <div class="row">
            <div class="col-3">
                @foreach($accounts as $account)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payAccountId" value="{{$account->id}}" required>
                            {{$account->nickName}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-2 border-right">
                @foreach($operationTypes as $operationType)
                    <div class="row">
                        <div class="col-12 clickable">
                            <input type="radio"  name="payOperationTypeId" value="{{$operationType->id}}" required>
                            {{$operationType->name}}
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-3">
                        Водитель
                    </div>
                    <div class="col-1">
                        <a href="/contract/addDriver" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
                        <input id="driverText" disabled />
                        <input name="carDriverId" id="driverId" value=""  hidden />
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        Владелец
                    </div>
                    <div class="col-1">
                        <a href="/carOwner/searchDialog" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
                    </div>
                    <div class="col-7">
                        <input id="carOwnerText" disabled />
                        <input name="carOwnerId" id="carOwnerId" value=""  hidden />
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        Имя
                    </div>
                    <div class="col-9">
                        <input type="text" name="name" id="name"/>
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
                        <input id="carText" disabled />
                        <input name="carId" id="carId" value=""  hidden />
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
                        <input id="carGroupText" name="carGroupText" disabled />
                        <input name="carGroupId" id="carGroupId"  hidden />
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
                        <input id="contractText" disabled />
                        <input name="contractId" id="contractId" value=""  hidden />
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
                <input type="text" class="col-6" name="comment"/>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-2">
                Платеж завершен
            </div>
            <div class="col-10">
                <input type="checkbox" value="1"  name="finished"/>
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
