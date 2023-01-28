@extends('../adminIndex')


@section('header')
            <h5 class="m-0">Информация о физическом лице</h5>
@endsection

@section('content')
    <div class="row">
        <div class="col-2"><strong>Фамилия</strong></div>
        <div class="col-2 text-left">{{$subjectObj->surname}}</div>
        <div class="col-2"><strong>Имя</strong></div>
        <div class="col-2 text-left">{{$subjectObj->name}}</div>
        <div class="col-2"><strong>Отчество</strong></div>
        <div class="col-2 text-left">{{$subjectObj->patronymic}}</div>
    </div>
            
            
            
    <div class="row border-top mt-3">
        <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUserMin" href="/subject/addContact/{{$subjectObj->id}}"><i class="far fa-plus-square"></i></a></div>
        <div class="col-3"></div>
        <div class="col-4 text-center pt-3"><h5> Контакты</h5></div>
    </div>
            @forelse($subjectObj->contacts as $subjectContact)
            <div class="row">
                <div class="col-2"><strong>Телефон</strong></div>
                <div class="col-2 text-left">{{$subjectContact->phone}}</div>
            </div>
            @empty
            <div class="row ">
                <div class="col-12 text-center"> <h6> Контакты не добавлены</h6></div>
            </div>
            @endforelse
            
            <div class="row border-top mt-3">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addPayment?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Платежные реквизиты</h5></div>
            </div>
            @forelse($subjectObj->payments as $subjectPayment)
            <div class="row">
                <div class="col-2"><strong>Расчетный счет</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->checkingAccount}}</div>
                <div class="col-2"><strong>Банк</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->bankName}}</div>
                <div class="col-2"><strong>ИНН банка</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->bankInn}}</div>
            </div>
            <div class="row">
                <div class="col-2"><strong>БИК банка</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->bankBik}}</div>
                <div class="col-2"><strong>к/сч</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->correspondentAccount}}</div>
                <div class="col-2"><strong>Юридический адрес</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->address}}</div>
            </div>
            <div class="row">
                <div class="col-2"><strong>Название филиала</strong></div>
                <div class="col-2 text-left">{{$subjectPayment->name}}</div>
            </div>
            @empty
             <div class="row ">
                <div class="col-12 text-center"> <h6> Платежные реквизиты не добавлены</h6></div>
            </div>
            @endforelse
            <div class="row border-top mt-3">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addPassport?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Паспорт</h5></div>
            </div>
            
             @forelse($subjectObj->passports as $subjectPassport)
                <div class="row ">
                    <div class="col-2"><strong>Номер</strong></div>
                    <div class="col-3 text-left">{{$subjectPassport->number}}</div>
                    <div class="col-1"><strong>Выдан</strong></div>
                    <div class="col-4 text-left">{{$subjectPassport->issuedBy}}</div>
                    <div class="col-1 p-0"><strong>Дата выдачи</strong></div>
                    <div class="col-1 p-0">{{$subjectPassport->dateIssued}}</div>
                </div>
                <div class="row ">
                    <div class="col-2"><strong>Место рождения</strong></div>
                    <div class="col-3 text-left">{{$subjectPassport->birthplace}}</div>
                    <div class="col-1"><strong>Прописка</strong></div>
                    <div class="col-4 text-left">{{$subjectPassport->placeResidence}}</div>
                    <div class="col-1 p-0"><strong>Дата</strong></div>
                    <div class="col-1 p-0">{{$subjectPassport->dateResidence}}</div>
                </div>
            @empty
            <div class="row ">
                <div class="col-12 text-center"> <h6> Паспорт не добавлен</h6></div>
            </div>
            @endforelse
            
            
            <div class="row border-top mt-3">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success" href=""><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Права</h5></div>
            </div>
              @forelse($subjectObj->licenses as $subjectLicense)
                <div class="row ">
                    
                </div>
            @empty
            <div class="row ">
                <div class="col-12 text-center"> <h6> Права не добавлены</h6></div>
            </div>
            @endforelse
            
@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

