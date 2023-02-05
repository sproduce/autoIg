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
            
            <div class="row border-top border-dark mt-3 pt-2">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addPayment?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Платежные реквизиты</h5></div>
            </div>
            @forelse($subjectObj->payments as $subjectPayment)
            <div class="row @if(!$loop->first) border-top mt-3 pt-2 @endif">
                <div class="col-11">
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
                </div>
                <div class="col-1">
                    <div class="row">
                        <div class="col-6">
                            <a class="btn btn-ssm btn-outline-warning DialogUser" href="/document/addPayment/{{$subjectPayment->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                        </div>
                        <div class="col-6">
                            <a href="/file/fileInfoDialog/{{$subjectPayment->uuid}}" class="btn btn-ssm @if($subjectPayment->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if(!$subjectPayment->actual)
                                <a class="btn btn-ssm btn-outline-primary" href="/document/actualPayment/{{$subjectPayment->id}}" title="Актуальные данные">
                                    <i class="fas fa-check"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            @empty
             <div class="row ">
                <div class="col-12 text-center"> <h6> Платежные реквизиты не добавлены</h6></div>
            </div>
            @endforelse
            <div class="row border-top mt-3 pt-2 border-dark">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addPassport?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Паспорт</h5></div>
            </div>
            
             @forelse($subjectObj->passports as $subjectPassport)
                <div class="row @if(!$loop->first) border-top mt-3 pt-2 @endif">
                    <div class="col-11">
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
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-ssm btn-outline-warning DialogUser" href="/document/addPassport/{{$subjectPassport->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            </div>
                            <div class="col-6">
                                <a href="/file/fileInfoDialog/{{$subjectPassport->uuid}}" class="btn btn-ssm @if($subjectPassport->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if(!$subjectPassport->actual)
                                    <a class="btn btn-ssm btn-outline-primary" href="/document/actualPassport/{{$subjectPassport->id}}" title="Актуальные данные">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="row">
                <div class="col-12 text-center"> <h6> Паспорт не добавлен</h6></div>
            </div>
            @endforelse
            
            
            <div class="row border-top mt-3 pt-2 border-dark">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addLicense?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Права</h5></div>
            </div>
              @forelse($subjectObj->licenses as $subjectLicense)
                <div class="row @if(!$loop->first) border-top mt-3 pt-2 @endif">
                    <div class="col-11">
                        <div class="row">
                            <div class="col-2"><strong>Номер</strong></div>
                            <div class="col-2 text-left">{{$subjectLicense->number}}</div>
                            <div class="col-2"><strong>Город выдачин</strong></div>
                            <div class="col-2 text-left">{{$subjectLicense->city}}</div>
                            <div class="col-2 p-0"><strong>Кем выдан</strong></div>
                            <div class="col-2 p-0">{{$subjectLicense->issuedBy}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2"><strong>Дата начала</strong></div>
                            <div class="col-2 text-left">{{$subjectLicense->start}}</div>
                            <div class="col-2"><strong>Дата окончания</strong></div>
                            <div class="col-2 text-left">{{$subjectLicense->finish}}</div>
                            <div class="col-2 p-0"><strong>Категории</strong></div>
                            <div class="col-2 p-0">{{$subjectLicense->categories}}</div>
                        </div>
                         </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-ssm btn-outline-warning DialogUser" href="/document/addLicense/{{$subjectLicense->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            </div>
                            <div class="col-6">
                                <a href="/file/fileInfoDialog/{{$subjectLicense->uuid}}" class="btn btn-ssm @if($subjectLicense->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @if(!$subjectLicense->actual)
                                    <a class="btn btn-ssm btn-outline-primary" href="/document/actualLicense/{{$subjectLicense->id}}" title="Актуальные данные">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
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

