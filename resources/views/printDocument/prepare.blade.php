@extends('../adminIndex')

@section('header')
            <h5 class="m-0">Список переменных</h5>
@endsection



@section('content')
    
    <form id="documentForm" method="post" action="/printDocument/generation/{{$documentId}}">
        <button type="submit" class="btn btn-sm btn-outline-success" id="downloadButton">Скачать</button>
        @csrf
        <input name="contractId" value="{{$contractId}}" hidden>
    
        @forelse($variableArray as $key =>$variable)
            @if ($loop->odd)
            <div class="row">
                @endif
                <div class="col-2 @if(isset($variableConfig[$key][2])) text-primary @endif">{{$key}}</div>
                <div class="col-4"><input name="value[{{$key}}]" style="width: 100%;" value="{{$variable}}"/></div>
                @if($loop->even)
            </div>
            @endif
        @empty
            Переменные не найдены
        @endforelse
            
            </form>

    
    
   
    
    
    
@endsection
