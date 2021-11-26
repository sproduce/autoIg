@extends('../adminIndex')


@section('header')
    <a class="btn btn-ssm btn-outline-success mr-3" title="Добавить договор" href="/contract/add"><i class="far fa-plus-square"></i></a>
    <h6 class="m-0">Договора</h6>
@endsection

@section('content')


    <div class="card text-center">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link" href="/contract/actualList">Актуальные</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" >Завершенные</a>
                </li>
            </ul>
        </div>
        <div class="card-body">


        </div>
    </div>











@endsection


