    <div class="form-row text-center">
        <div class="form-group col-md-3 input-group-sm">
            <label for="start" title="Начало аренда">Начало аренды</label>
            <input type="datetime-local" name="start" id="start" class="form-control" value="{{date('Y-m-d')}}T{{date('h:i')}}"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="finish" title="Окончание аренды">Окончание аренды</label>
            <input type="datetime-local" name="finish" id="finish" class="form-control"/>
        </div>
        <div class="form-group col-md-3 input-group-sm">
            <label for="contractText" title="Договор">
                Договор
                <a href="/payment/addContract" class="btn btn-ssm btn-outline-success DialogUser mr-3"><i class="fas fa-search-plus"></i></a>
            </label>
            <input id="contractText" name="contractText"  class="form-control" disabled />
            <input name="contractId" id="contractId" value=""  hidden />
        </div>

        <div class="form-group col-md-3 input-group-sm">
            <label for="sum" title="Сумма за период">Сумма за период</label>
            <input type="number" name="sum" id="sum" class="form-control"/>
        </div>

    </div>

</div>
