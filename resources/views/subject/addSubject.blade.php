
@extends('../adminIndex')

@section('content')



    <form method="POST" action="/subject/add">
        <input name="id" type="number" value="{{$subjectObj->id}}" hidden/>
        @csrf

    <div class="form-row text-center">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="individual" name="individual" value="1" @if(old('individual',$subjectObj->individual)) checked @endif>
            <label class="form-check-label" for="individual">Физ лицо</label>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="surname" title="Фамилия">Фамилия</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{old('surname',$subjectObj->surname)}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="name" title="Имя">Имя</label>
            <input type="text" name="name" id="name" class="form-control" value="{{old('name',$subjectObj->name)}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="patronymic" title="Отчество">Отчество</label>
            <input type="text" name="patronymic" id="patronymic" class="form-control" value="{{old('patronymic',$subjectObj->patronymic)}}"/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="birthday" title="Дата">Дата</label>
            <input type="date" name="birthday" id="birthday" class="form-control" value="{{old('birthday',$subjectObj->birthday)}}"/>
        </div>
        <div class="form-group col-md-1 input-group-sm">
            <div class="col-sm-3 pr-0">
                <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                    <input class="form-check-input" type="radio" name="male" id="male1" value="1" @if(old('male',$subjectObj->male))checked @endif>
                    <label class="form-check-label" for="male1">М</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                    <input class="form-check-input" type="radio" name="male" id="male2" value="0" @if(!old('male',$subjectObj->male))checked @endif>
                    <label class="form-check-label" for="male2">Ж</label>
                </div>
            </div>
        </div>



    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="companyName" title="Организация">Организация</label>
            <input type="text" name="companyName" id="companyName" class="form-control" value="{{old('ompanyName',$subjectObj->companyName)}}"/>
        </div>

        <div class="form-group col-md-3 input-group-sm">
            <label for="nickname" title="NickName">NickName</label>
            <input type="text" name="nickname" id="nickname" class="form-control" value="{{old('nickname',$subjectObj->nickname)}}"/>
        </div>
        <div class="form-group col-md-6 input-group-sm">
            <label for="comment" title="Комментарий">Комментарий</label>
            <input type="text" name="comment" id="comment" class="form-control" value="{{old('comment',$subjectObj->comment)}}"/>
        </div>
    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-2 input-group-sm">
            <label for="regionId" title="Регион">Регион</label>
            <select class="form-control" name="regionId" id="regionId">
                @foreach($regionsObj as $regionObj)
                    <option value="{{$regionObj->id}}" @if($regionObj->id==old('regionId',$subjectObj->regionId)) selected @endif>{{$regionObj->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-1 input-group-sm">
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="payAccountId" title="Платежные реквизиты">Реквизиты платежа</label>
            <select class="form-control" name="payAccountId" id="payAccountId">
                <option value="">Выберите реквизиты</option>
                @foreach($payAccountsObj as $payAccountObj)
                    <option value="{{$payAccountObj->id}}" @if($payAccountObj->id==old('payAccountId',$subjectObj->payAccountId)) selected @endif>{{$payAccountObj->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-3 input-group-sm text-left ml-4">
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="client" name="client" value="1" @if(old('client',$subjectObj->client)) checked @endif>
                        <label class="form-check-label" for="client">Клиент</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="carOwner" name="carOwner" value="1" @if(old('carOwner',$subjectObj->carOwner)) checked @endif>
                        <label class="form-check-label" for="carOwner">Владелец</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="accessible" name="accessible" value="1" @if(old('accessible',$subjectObj->accessible)) checked @endif>
                        <label class="form-check-label" for="accessible">Доступ</label>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Записать"/>
        </div>
    </div>
</form>
@endsection
