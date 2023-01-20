@extends('../adminIndex')


@section('header')
            <h5 class="m-0">Информация о юридическом лице</h5>
@endsection

@section('content')
            
            
            <div class="row">
                
            </div>
            
            
    
            <div class="row border-top mt-3">
                <div class="col-12 text-center pt-2"> <h5> Документы</h4></div>
            </div>
            
            
            
@endsection

@section('js')


    <script>
        $('#modal').on('shown.bs.modal', function (e) {
            $('.phone').inputmask("+7(999) 999-99-99");

        })


    </script>
@endsection

