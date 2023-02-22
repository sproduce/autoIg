@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить субьект" href="/subject/add"><i class="far fa-plus-square"></i></a>
            <h6 class="m-0">Субьекты</h6>
@endsection

@section('content')
    @if($subjectsObj->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">
                ФИО/Название
            </div>
            <div class="col-2">
                Дата
            </div>
            <div class="col-1">
                Пол
            </div>
            <div class="col-2">
                Телефон
            </div>
            <div class="col-2">
                Nickname
            </div>
            <div class="col-2">

            </div>
        </div>


        @foreach($subjectsObj as $subject)
            <div class="row row-table">
                <div class="col-3">
                    <a href="/subject/fullInfoDialog/{{$subject->id}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    <a href="/subject/fullInfo/{{$subject->id}}" title="Информация о субьекте">
                        {{$subject->surname}}  {{$subject->name}} {{$subject->patronymic}}
                        @if($subject->companyName)
                            <b>/ {{$subject->companyName}}</b>
                        @endif
                    </a>
                    
                </div>
                <div class="col-2">
                    @if ($subject->birthday)
                        {{$subject->birthday->format('d-m-Y')}}
                    @endif
                </div>
                <div class="col-1">
                    @if($subject->individual)
                        @if($subject->male)
                            Муж
                        @else
                            Жен
                        @endif
                    @endif
                </div>
                <div class="col-2">{{$subject->actualContact->phone}}</div>
                <div class="col-2">
                    {{$subject->nickname}}
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-8"></div>
<!--                        <div class="col-4 p-0">
                            @if($subject->individual)
                                <a href="/document/addPassport/{{$subject->uuid}}" class="btn btn-ssm btn-outline-success DialogUser" title="Паспорт"><i class="fas fa-passport"></i></a>
                                <a href="" class="btn btn-ssm btn-outline-success DialogUser" title="Права"><i class="fas fa-id-card"></i></a>
                                @else                                
                                <a href="" class="btn btn-ssm btn-outline-success DialogUser" title="Информация юр. лицо"><i class="far fa-file-alt"></i></a>
                                
                            @endif
                        </div>
                        <div class="col-2 p-0">
                            <a href="/document/addPayment/{{$subject->uuid}}" class="btn btn-ssm btn-outline-success DialogUser" title="Счет"><i class="fas fa-file-invoice-dollar"></i></a>
                        </div>
                        <div class="col-2 p-0">                        
                            <a href="/subject/addContact/{{$subject->id}}" class="btn btn-ssm btn-outline-success DialogUserMin" title="Контакты"><i class="fas fa-phone"></i></a>
                        </div>-->
    {{--                    <a href="/contract/add?carDriverId={{$carDriver->id}}" title="Добавить договор" class="btn btn-ssm btn-outline-secondary">--}}
    {{--                        <i class="fas fa-file-contract"></i>--}}
    {{--                    </a>--}}
                        <div class="col-4 p-0">

                            <a class="btn btn-ssm btn-outline-warning" href="/subject/edit?subjectId={{$subject->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                            <a href="/subject/delete?subjectId={{$subject->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить субьекта?')"><i class="fas fa-trash"></i> </a>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Субьекты не добавлены</h5>
            </div>
        </div>
    @endif






@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

