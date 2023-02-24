    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Информация о субьекте Юр. лицо</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>



    <div class="modal-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <strong>Организация</strong>
                </div>
                <div class="col-md-4">
                    {{$subjectObj->companyName}}
                </div>
                <div class="col-md-2">
                    <strong>NickName</strong>
                </div>
                <div class="col-md-4">
                    {{$subjectObj->nickname}}
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-md-2">
                    <strong>Регион</strong>
                </div>
                <div class="col-md-4">
                    {{$subjectObj->region->name}}
                </div>
                 <div class="col-md-2">
                    <strong>Телефон</strong>
                </div>
                <div class="col-md-4">
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

