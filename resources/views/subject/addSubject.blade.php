
@extends('../adminIndex')

@section('content')

<form method="POST" action="/subject/add">
    @csrf
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="surname" title="Фамилия">Фамилия</label>
            <input type="text" name="surname" id="surname" class="form-control" value=""/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="name" title="Имя">Имя</label>
            <input type="text" name="name" id="name" class="form-control" value=""/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="patronymic" title="Отчество">Отчество</label>
            <input type="text" name="patronymic" id="patronymic" class="form-control" value=""/>
        </div>
        <div class="form-group col-md-2 input-group-sm">
            <label for="birthday" title="Дата">Дата</label>
            <input type="date" name="birthday" id="birthday" class="form-control" value=""/>
        </div>
        <div class="form-group col-md-1 input-group-sm">
            <div class="col-sm-3 pr-0">
                <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                    <input class="form-check-input" type="radio" name="male" id="male1" value="1" checked>
                    <label class="form-check-label" for="male1">М</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline form-control-sm m-0">
                    <input class="form-check-input" type="radio" name="male" id="male2" value="0">
                    <label class="form-check-label" for="male2">Ж</label>
                </div>
            </div>
        </div>



    </div>
    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="companyName" title="Фамилия">Организация</label>
            <input type="text" name="companyName" id="companyName" class="form-control" value=""/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="nickname" title="Фамилия">NickName</label>
            <input type="text" name="nickname" id="nickname" class="form-control" value=""/>
        </div>

    </div>




    <div class="form-row text-center" id="last-row">
        <div class="input-group col-1">
            <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Добавить"/>
        </div>
    </div>
</form>
@endsection
