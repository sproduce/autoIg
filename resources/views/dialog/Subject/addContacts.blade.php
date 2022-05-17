    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Контакты субьекта</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form method="POST" action="/subject/addContact">
        @csrf

    <div class="modal-body">
        <div class="container-fluid">
            <div class="form-group row inputLine">
                <label for="phone" class="col-sm-2 col-form-label form-control-sm">Телефон</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control form-control-sm phone" name="phone[]" autocomplete="off" required/>
                </div>
            </div>
            <div class="row" id="contact-last-row">
                <div class="col-4">
                    <a class="btn btn-ssm btn-outline-success" onclick="remove_input();" title="Удалить строку"><i class="far fa-minus-square"></i></a>
                    <a class="btn btn-ssm btn-outline-success" onclick="add_input();" title="Добавить строку"><i class="far fa-plus-square"></i></a>
                </div>
            </div>
        </div>
    </div>




    <div class="modal-footer d-flex justify-content-center">
        <div class="form-row text-center">
            <div class="input-group col-1">
                <input type="submit" id="formSubmit" class="btn btn-sm btn-primary mb-2" value="Записать"/>
            </div>
        </div>
    </div>

    </form>

    <script type="text/javascript">
        var kol_line=1;

        function add_input(){
            var copyLine=$('.inputLine:first').clone(true);
            copyLine.find("input:text").val("");
            copyLine.insertBefore("#contact-last-row");
            kol_line++;
            console.log(copyLine.html());
        }

        function remove_input(){
            if(kol_line>1){
                kol_line--;
                $('.inputLine:last').remove();
            }
        }


    </script>
