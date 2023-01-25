@extends('../adminIndex')


@section('header')
            <h5 class="m-0">Информация о юридическом лице</h5>
@endsection

@section('content')
            
            
            <div class="row">
                <div class="col-2"><strong>Название организации</strong></div>
                <div class="col-3 text-left">{{$subjectObj->companyName}}</div>
                <div class="col-2"><strong>NickName</strong></div>
                <div class="col-3 text-left">{{$subjectObj->nickname}}</div>
            </div>
            
            
    
 <div class="row border-top mt-3">
        <div class="col-1"><a class="btn btn-ssm btn-outline-success" href=""><i class="far fa-plus-square"></i></a></div>
        <div class="col-3"></div>
        <div class="col-4 text-center pt-3"><h5> Контакты</h5></div>
    </div>
            @forelse($subjectObj->contacts as $subjectContact)
            <div class="row ">
                <div class="col-2"><strong>Телефон</strong></div>
                <div class="col-2 text-left">{{$subjectContact->phone}}</div>
            </div>
            @empty
            <div class="row ">
                <div class="col-12 text-center"> <h6> Контакты не добавлены</h6></div>
            </div>
            @endforelse
            
            <div class="row border-top mt-3">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success" href=""><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Платежные реквизиты</h5></div>
            </div>
            <div class="row border-top mt-3">
                <div class="col-1"><a class="btn btn-ssm btn-outline-success" href=""><i class="far fa-plus-square"></i></a></div>
                <div class="col-3"></div>
                <div class="col-4 text-center pt-3"><h5>Полное официальное название</h5></div>
            </div>
            
@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

