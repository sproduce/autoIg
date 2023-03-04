@extends('../adminIndex')

@section('header')
            <h5 class="m-0">Список переменных</h5>
@endsection



@section('content')
    <form method="post" action="/printDocument/generation/{{$documentId}}">
        @csrf
        <input name="contractId" value="{{$contractId}}" hidden>
    <button type="submit" class="btn btn-sm btn-outline-success">Скачать</button>
        @forelse($variableArray as $key =>$variable)
            @if ($loop->odd)
            <div class="row">
                @endif
                <div class="col-2">{{$key}}</div>
                <div class="col-4"><input name="value[{{$key}}]" style="width: 100%;" value="{{$variable}}"/></div>
                @if($loop->even)
            </div>
            @endif
        @empty
            Переменные не найдены
        @endforelse
            
            </form>

@endsection
