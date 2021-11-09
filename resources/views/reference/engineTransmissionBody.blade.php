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
            @foreach($types['engine'] as $engine)
                <div class="row">
                    <div class="col-10">
                        {{$engine->name}}
                    </div>
                    <div class="col-2">
                        <a class="btn btn-ssm btn-outline-warning DialogUserSMin" title="Редактировать" href="" ><i class="far fa-edit"></i></a>
                        <div class="float-right">
                            <a href="" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить?')"><i class="fas fa-trash"></i> </a>
                        </div>
                    </div>
                </div>

            @endforeach
            <div class="row">
                <div class="col-12">
                        <a class="btn btn-ssm btn-outline-success DialogUserSMin mt-5" title="Добавить" href=""><i class="far fa-plus-square"></i></a>
                </div>
            </div>
        </div>
        <div class="tab-pane fade mt-2" id="nav-body" role="tabpanel" aria-labelledby="nav-body-tab">
            @foreach($types['body'] as $body)
                <div class="row">
                    <div class="col-10">
                        {{$body->name}}
                    </div>
                    <div class="col-2">
                        <a class="btn btn-ssm btn-outline-warning DialogUserSMin" title="Редактировать" href="" ><i class="far fa-edit"></i></a>
                        <div class="float-right">
                            <a href="" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить?')"><i class="fas fa-trash"></i> </a>
                        </div>
                    </div>
                </div>

            @endforeach
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-ssm btn-outline-success DialogUserSMin mt-5" title="Добавить" href=""><i class="far fa-plus-square"></i></a>
                    </div>
                </div>
        </div>
        <div class="tab-pane fade mt-2" id="nav-transmission" role="tabpanel" aria-labelledby="nav-transmission-tab">
            @foreach($types['transmission'] as $transmission)
                <div class="row">
                    <div class="col-10">
                        {{$transmission->name}}
                    </div>
                    <div class="col-2">
                        <a class="btn btn-ssm btn-outline-warning DialogUserSMin" title="Редактировать" href="" ><i class="far fa-edit"></i></a>
                        <div class="float-right">
                            <a href="" class="btn btn-ssm btn-outline-danger" title="Удалить" onclick="return confirm('Удалить?')"><i class="fas fa-trash"></i> </a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="row">
               <div class="col-12">
                    <a class="btn btn-ssm btn-outline-success DialogUserSMin mt-5" title="Добавить" href=""><i class="far fa-plus-square"></i></a>
               </div>
            </div>
        </div>



    </div>





@endsection


