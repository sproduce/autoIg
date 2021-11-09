@extends('../adminIndex')


@section('header')


            <h6>Справочник</h6>




@endsection

@section('content')


    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-engine-tab" data-toggle="tab" href="#nav-engine" role="tab" aria-controls="nav-engine" aria-selected="true">Двигатели</a>
            <a class="nav-item nav-link" id="nav-body-tab" data-toggle="tab" href="#nav-body" role="tab" aria-controls="nav-body" aria-selected="false">Кузова</a>
            <a class="nav-item nav-link" id="nav-transmission-tab" data-toggle="tab" href="#nav-transmission" role="tab" aria-controls="nav-transmission" aria-selected="false">КПП</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active mt-2" id="nav-engine" role="tabpanel" aria-labelledby="nav-engine-tab">
            Engine
        </div>
        <div class="tab-pane fade mt-2" id="nav-body" role="tabpanel" aria-labelledby="nav-body-tab">
            Body
        </div>
        <div class="tab-pane fade mt-2" id="nav-transmission" role="tabpanel" aria-labelledby="nav-transmission-tab">
            Transmission
        </div>



    </div>





@endsection


