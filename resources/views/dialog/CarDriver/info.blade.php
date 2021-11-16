    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Информация о водителе</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>



    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 text-right">
                    <strong>Фамилия</strong>
                </div>
                <div class="col-md-4">
                    {{$carDriver->surname}}
                </div>
                <div class="col-md-2 text-right">
                    <strong>Имя</strong>
                </div>
                <div class="col-md-4">
                    {{$carDriver->name}}
                </div>
            </div>


            <div class="row">
                <div class="col-md-2 text-right">
                    <strong>Отчество</strong>
                </div>
                <div class="col-md-4">
                    {{$carDriver->patronymic}}
                </div>
                <div class="col-md-2 text-right">
                    <strong>nickName</strong>
                </div>
                <div class="col-md-4">
                    {{$carDriver->nickName}}
                </div>
            </div>

            <div class="row">
                <div class="col-md-2 pl-0 text-right">
                    <strong>Дата рождения</strong>
                </div>
                <div class="col-md-2">
                    {{$carDriver->birthday}}
                </div>
                <div class="col-md-1 text-right">
                    <strong>Пол</strong>
                </div>
                <div class="col-md-1">
                    @if($carDriver->male)Муж
                        @else Жен
                        @endif
                </div>
                <div class="col-md-2 text-right"> <strong>Регион</strong></div>
                <div class="col-4">{{$carDriver->region->name}}</div>
            </div>


            <div class="row border-top mt-2 pt-2">
                <div class="col-md-2 text-right">
                    <strong>Телефон</strong>
                </div>

                @foreach($carDriver->contacts as $contact)
                    <div class="col-md-2 p-0">
                        {{$contact->phone}}
                    </div>
                @endforeach

            </div>

            <div class="row border-top mt-2 pt-2">
                <div class="col-md-1 text-right">
                    <strong>Комментарий</strong>
                </div>
                <div class="col-md-1">
                    {{$carDriver->comment}}
                </div>
            </div>

        </div>
    </div>

