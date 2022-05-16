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
                    <a href="{{$subject->id}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    {{$subject->surname}}  {{$subject->name}} {{$subject->patronymic}}
                    @if($subject->companyName)
                      <b>/ {{$subject->companyName}}</b>
                    @endif
                </div>
                <div class="col-2">
                    @if ($subject->birthday)
                        {{$subject->birthday->format('d-m-Y')}}
                    @endif
                </div>
                <div class="col-1">
                    @if($subject->male)
                        Муж
                    @else
                        Жен
                    @endif
                </div>
{{--                @if($carDriver->contacts->count())--}}
{{--                <div class="col-2" title="@foreach($carDriver->contacts as $contact) {{$contact->phone}} @endforeach">--}}
{{--                    @if($carDriver->contacts->count())--}}
{{--                        {{$carDriver->contacts[0]->phone}}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--                @else--}}
{{--                    <div class="col-2"></div>--}}
{{--                @endif--}}
                <div class="col-2"></div>
                <div class="col-2">
                    {{$subject->nickname}}
                </div>
                <div class="col-2">
{{--                    <a href="/contract/add?carDriverId={{$carDriver->id}}" title="Добавить договор" class="btn btn-ssm btn-outline-secondary">--}}
{{--                        <i class="fas fa-file-contract"></i>--}}
{{--                    </a>--}}
                    <div class="float-right">
                        <a class="btn btn-ssm btn-outline-warning" href="/subject/edit?subjectId={{$subject->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                        <a href="/subject/delete?subjectId={{$subject->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить субьекта?')"><i class="fas fa-trash"></i> </a>
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

