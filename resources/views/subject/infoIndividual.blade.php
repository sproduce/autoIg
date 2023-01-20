@extends('../adminIndex')


@section('header')
            <h6 class="m-0">Информация о физическом лице</h6>
@endsection

@section('content')
    <div class="row">
                
    </div>
            
            
            
            
    
    <div class="row">
        <div class="col-12 text-center"> <h4> Документы</h4></div>
    </div>
            
            
            
@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

