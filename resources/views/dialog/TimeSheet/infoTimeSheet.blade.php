    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Подробно</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @foreach($timeSheets as $timeSheet)
        <div class="row">
            <div class="col-2" style="background-color:{{$timeSheet->event->color}}">{{$timeSheet->event->name}}</div>
            <div class="col-4" title="{{$timeSheet->comment}}">{{$timeSheet->dateTime}}</div>
            <div class="col-4">{{$timeSheet->sum}}</div>
        </div>

        @endforeach
    </div>

    <div class="modal-footer d-flex justify-content-center">

    </div>




