@extends('../adminIndex')

@section('header')
            <h5 class="m-0">Список переменных</h5>
@endsection



@section('content')
    <form method="post" action="/printDocument/generation/{{$documentId}}">
        @csrf

        @forelse($variableArray as $key =>$variable)
            <div class="row">
                <div class="col-2">{{$key}}</div>
                <div class="col-4"><input name="value[{{$key}}]" style="width: 100%;" value="{{$variable}}"/></div>
            </div>
        @empty
            Переменные не найдены
        @endforelse
            <button type="submit" class="btn btn-sm btn-outline-success">Скачать</button>
            </form>

@endsection
