@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3 DialogUserMin" title="Добавить водителя" href="/carDriver/add"><i class="far fa-plus-square"></i></a>
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
                    <a href="/contract/add?carDriverId={{$carDriver->id}}" title="Добавить договор" class="btn btn-ssm btn-outline-secondary">
                        <i class="fas fa-file-contract"></i>
                    </a>
                    <div class="float-right">
                        <a class="btn btn-ssm btn-outline-warning DialogUserMin" href="/carDriver/edit?carDriverId={{$carDriver->id}}" title="Редактировать"> <i class="far fa-edit"></i></a>
                        <a href="/carDriver/delete?carDriverId={{$carDriver->id}}" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить марку?')"><i class="fas fa-trash"></i> </a>
                    </div>
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






@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

