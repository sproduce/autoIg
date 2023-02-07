@extends('../adminIndex')


@section('header')
            <h5 class="m-0">Информация о юридическом лице</h5>
@endsection

@section('content')
    <div class="row">
        <div class="col-2"><strong>Название организации</strong></div>
        <div class="col-3 text-left">{{$subjectObj->companyName}}</div>
        <div class="col-2"><strong>NickName</strong></div>
        <div class="col-3 text-left">{{$subjectObj->nickname}}</div>
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
            
            <div class="row border-top mt-3 pt-2 border-dark">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addPayment?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Платежные реквизиты</h5></div>
            </div>
            @forelse($subjectObj->payments as $subjectPayment)
                <div class="row @if(!$loop->first) border-top mt-3 pt-2 @endif">
                    <div class="col-11 @if($subjectPayment->actual)bg-secondary @endif">
                        <div class="row">
                            <div class="col-2"><strong>Банк</strong></div>
                            <div class="col-2 text-left">{{$subjectPayment->bankName}}</div>
                            <div class="col-2"><strong>Расчетный счет</strong></div>
                            <div class="col-2 text-left">{{$subjectPayment->checkingAccount}}</div>
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
                                <a class="btn btn-ssm btn-outline-primary @if($subjectPayment->actual)disabled @endif" href="/document/actualPayment/{{$subjectPayment->id}}" title="Актуальные данные">
                                    <i class="fas fa-check"></i>
                                </a>
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
                <div class="col-1"><a class="btn btn-ssm btn-outline-success DialogUser" href="/document/addEntity?uuid={{$subjectObj->uuid}}"><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Карточка предприятия</h5></div>
            </div>
            
            @forelse($subjectObj->entities as $subjectEntity)
                <div class="row @if(!$loop->first) border-top mt-3 pt-2 @endif">
                    <div class="col-11 @if($subjectEntity->actual)bg-secondary @endif">
                        <div class="row">
                            <div class="col-3"><strong>Полное официальное название</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->fullName}}</div>
                            <div class="col-3"><strong>Сокращенное наименование</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->shortName}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Полное наименование на английском языке</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->englishName}}</div>
                            <div class="col-3"><strong>Наименование регистрирующего органа</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->nameReg}}</div>
                        </div>
                        <div class="row">
                            <div class="col-3"><strong>Юридический адрес</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->address}}</div>
                            <div class="col-3"><strong>Местонахождение</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->mailingAddress}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2"><strong>Телефон</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->phone}}</div>
                            <div class="col-2"><strong>ОГРН</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->ogrn}}</div>
                            <div class="col-2"><strong>ОКТМО</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->oktmo}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2"><strong>Дата государственной регистрации</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->dateReg}}</div>
                            <div class="col-2"><strong>ОКВЭД</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->okved}}</div>
                            <div class="col-2"><strong>ОКПО</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->okpo}}</div>
                        </div>
                        <div class="row">
                            <div class="col-2"><strong>ОКАТО</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->okato}}</div>
                            <div class="col-2"><strong>ОКОГУ</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->okogu}}</div>
                            <div class="col-2"><strong>ИНН</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->inn}}</div>
                        </div>
                         <div class="row">
                            <div class="col-2"><strong>КПП</strong></div>
                            <div class="col-2 text-left">{{$subjectEntity->kpp}}</div>
                        </div>
                         <div class="row">
                            <div class="col-3"><strong>Генеральный директор</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->director}}</div>
                            <div class="col-3"><strong>Главный бухгалтер</strong></div>
                            <div class="col-3 text-left">{{$subjectEntity->accountant}}</div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6">
                                <a class="btn btn-ssm btn-outline-warning DialogUser" href="/document/addEntity/{{$subjectEntity->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            </div>
                            <div class="col-6">
                                <a href="/file/fileInfoDialog/{{$subjectEntity->uuid}}" class="btn btn-ssm @if($subjectEntity->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-ssm btn-outline-primary @if($subjectEntity->actual)disabled @endif" href="/document/actualEntity/{{$subjectEntity->id}}" title="Актуальные данные">
                                    <i class="fas fa-check"></i>
                                </a>
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
                    <div class="col-12 text-center"> <h6> Информация не добавлена</h6></div>
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

