@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Водители</h6>
@endsection

@section('content')

    @if($carDrivers->count())
        <div class="row align-items-center font-weight-bold border">
            <div class="col-3">
                Фамилия | Имя | Отчество
            </div>
            <div class="col-2">
                Дата рождения
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
                Комментарий
            </div>
        </div>


        @foreach($carDrivers as $carDriver)
            <div class="row row-table">
                <div class="col-3">
                    <a href="/dialog/carDriverInfo?carDriverId={{$carDriver->id}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                    {{$carDriver->surname}}  {{$carDriver->name}} {{$carDriver->patronymic}}
                </div>
                <div class="col-2">
                    {{$carDriver->birthday}}
                </div>
                <div class="col-1">
                    @if($carDriver->male)
                        Муж
                    @else
                        Жен
                    @endif
                </div>
                @if($carDriver->contacts->count())
                <div class="col-2" title="@foreach($carDriver->contacts as $contact) {{$contact->phone}} @endforeach">
                    @if($carDriver->contacts->count())
                        {{$carDriver->contacts[0]->phone}}
                    @endif
                </div>
                @else
                    <div class="col-2"></div>
                @endif
                <div class="col-2">
                    {{$carDriver->nickname}}
                </div>
                <div class="col-2">
                    {{$carDriver->comment}}
                </div>

            </div>
        @endforeach
    @else
        <div class="row">
            <div class="col-12 text-center">
                <h5>Водители не добавлены</h5>
            </div>
        </div>
    @endif

    <div class="row mt-4">
        <div class="col-12">
            <a class="btn btn-ssm btn-outline-success DialogUserMin" title="Добавить договор" href="/carDriver/add"><i class="far fa-plus-square"></i></a>
        </div>
    </div>




@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

