    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Переменные</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
           @foreach($variableArray as $key =>$variable)
                @if ($loop->odd)
                    <div class="row">
                @endif
                    <div class="col-2">{{$key}}</div>
                    <div class="col-4">{{$variable[1]}}</div>
                @if($loop->even)
                    </div>
                @endif    
           @endforeach
            
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">

    </div>
</form>
 