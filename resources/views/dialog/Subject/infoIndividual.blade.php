    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Информация о субьекте Физ. лицо</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>



    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <strong>Фамилия</strong>
                </div>
                <div class="col-md-2">
                    {{$subjectObj->surname}}
                </div>
                <div class="col-md-2">
                    <strong>Имя</strong>
                </div>
                <div class="col-md-2">
                    {{$subjectObj->name}}
                </div>
                <div class="col-md-2">
                    <strong>Отчество</strong>
                </div>
                <div class="col-md-2">
                    {{$subjectObj->patronymic}}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    <strong>Дата</strong>
                </div>
                <div class="col-md-2">
                    @if($subjectObj->birthday)
                        {{$subjectObj->birthday->format('d-m-Y')}}
                    @endif
                </div>
                <div class="col-md-2">
                    <strong>Пол</strong>
                </div>
                <div class="col-md-2">
                    @if($subjectObj->male)
                        М
                    @else 
                        Ж
                    @endif
                </div>
                <div class="col-md-2">
                    <strong>Nickname</strong>
                </div>
                <div class="col-md-2">
                      {{$subjectObj->nickname}}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-2">
                    <strong>Регион</strong>
                </div>
                <div class="col-md-2">
                      {{$subjectObj->region->name}}
                </div>
                <div class="col-md-2">
                    <strong>Реквизиты</strong>
                </div>
                <div class="col-md-2">
                    {{$subjectObj->payAccount->nickName}}
                </div>
                <div class="col-md-2">
                    <strong>Телефон</strong>
                </div>
                <div class="col-md-2">
                     {{$subjectObj->actualContact->phone}}
                </div>
            </div>
            
        </div>
    </div>
    <div class="modal-footer">
        <div class="row mt-2 w-100">
            <div class="col-md-2">
                <strong>Комментарий</strong>
            </div>
            <div class="col-md-10">
                {{$subjectObj->comment}}
            </div>
        </div>
    </div>