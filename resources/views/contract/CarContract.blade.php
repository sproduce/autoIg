@extends('../adminIndex')

@php
    $contractTypes=$directoryObj->get('type');
    $contractStatuses=$directoryObj->get('status');
@endphp
@section('header')
    @if ($rentContractObj->id)
        <h6 class="m-0">Редактировать договор</h6>
    @else
        <h6 class="m-0">Добавить договор</h6>
    @endif
@endsection
@section('content')
    <form method="POST" action="/contract/add">
    @if ($rentContractObj->id)
        <input type="number" name="id" id="id" value="{{$rentContractObj->id}}" hidden/>
    @endif

    @csrf
    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-row text-center">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="start" title="Начало договора">Начало договора</label>
                    <input type="datetime-local" name="start" id="start" class="form-control" value="{{old('start',$rentContractObj->start ? $rentContractObj->start->format('Y-m-d\TH:i:s') : date('Y-m-d\TH:i:s'))}}" required/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finish" title="Окончание договора">Окончание договора</label>
                    <input type="datetime-local" name="finish" id="finish" value="{{old('finish',$rentContractObj->finish ? $rentContractObj->finish->format('Y-m-d\TH:i:s') : '')}}" class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="finishFact" title="Окончание договора">Окончание договора по факту</label>
                    <input type="datetime-local" name="finishFact" id="finishFact" @if ($rentContractObj->finishFact) value="{{$rentContractObj->finishFact->format('Y-m-d\TH:i:s')}}" @endif class="form-control"/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="typeId" title="Тип договора">Тип договора</label>
                    <select name="typeId" id="typeId" class="form-control">
                        @foreach($contractTypes as $contractType)
                            <option value="{{$contractType->id}}" @if ($rentContractObj->typeId == $contractType->id) selected @endif>{{$contractType->name}}</option>
                        @endforeach

                    </select>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="carText" title="Машина">Машина</label>
                    <a href="/motorPool/addCarTo" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                    <input id="carText" name="carText" class="form-control" value="{{old('carText')}}" readonly/>
                    <input name="carId" id="carId" value="{{old('carId',$rentContractObj->carId)}}" hidden/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="carGroupText" title="Группа машин">Группа машин</label>
                    <a href="/carGroup/addCarGroupTo" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                    <input id="carGroupText" class="form-control" readonly/>
                    <input name="carGroupId" id="carGroupId"  hidden/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="subjectFromText" title="От кого">От кого</label>
                    <a href="/subject/addSubjectTo/subjectFrom" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                        <input id="subjectFromText" class="form-control" readonly/>
                        <input name="subjectIdFrom" id="subjectFromId"  hidden/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="subjectToText" title="Клиент">Клиент</label>
                    <a href="/subject/addSubjectTo/subjectTo" class="btn btn-ssm btn-outline-success ml-2 DialogUser"><i class="fas fa-search-plus"></i></a>
                        <input id="subjectToText" class="form-control" readonly/>
                        <input name="subjectIdTo" id="subjectToId"  hidden/>
                </div>
            </div>

            <div class="form-row text-center mt-3">
                <div class="form-group col-md-3 input-group-sm">
                    <label for="price" title="Тариф договора">Тариф договора в сутки</label>
                    <input type="number" name="price" id="price" class="form-control" @if ($rentContractObj->price) value="{{$rentContractObj->price}}" @endif/>
                </div>
{{--                <div class="form-group col-md-2 input-group-sm">--}}
{{--                    <label for="deposit" title="Депозит договора">Депозит договора</label>--}}
{{--                    <input type="number" name="deposit" id="deposit" class="form-control" @if ($rentContractObj->deposit) value="{{$rentContractObj->deposit}}" @endif/>--}}
{{--                </div>--}}
                <div class="form-group col-md-3 input-group-sm">
                    <label for="number" title="Номер договора">Номер договора</label>
                    <input type="text" name="number" id="number" class="form-control" autocomplete="off" required @if ($rentContractObj->number) value="{{$rentContractObj->number}}" @endif/>
                </div>
                <div class="form-group col-md-3 input-group-sm">
                    <label for="statusId" title="Статус договора">Статус договора</label>
                    <select name="statusId" id="statusId" class="form-control">
                        @foreach($contractStatuses as $contractStatus)
                            <option value="{{$contractStatus->id}}" @if ($rentContractObj->statusId == $contractStatus->id) selected @endif>{{$contractStatus->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row text-center mt-3">
                <div class="form-group col-md-12 input-group-sm">
                    <label for="comment" title="Комментарий">Комментарий</label>
                    <input type="text" name="comment" id="comment" class="form-control" @if ($rentContractObj->comment) value="{{$rentContractObj->comment}}" @endif/>
                </div>

            </div>
        </div>

        <div class="modal-footer d-flex justify-content-center">
            @if ($rentContractObj->id)
                <input type="submit" class="btn btn-primary" value="Сохранить">
            @else
                <input type="submit" class="btn btn-primary" value="Добавить">
            @endif

        </div>
    </div>
</form>
@endsection
@section('js')
    <script>
        $('#carId').change(function() {
            $.get("/api/getCarGroups",{carId:$('#carId').val()}).done(function( data ) {
                if (data.length){
                    $('#carGroupText').val(data[0].nickName);
                    $('#carGroupId').val(data[0].id);
                }
            });
        });
    </script>
@endsection
