 @if($filesObj->count())
    <div class="row border-top mt-3">
        <div class="col-12 text-center"><strong>Файлы</strong></div>
    </div>
    @foreach($filesObj as $file)
        <div class="row">
            <div class="col-4">
                <a href="">
                    {{$file->fileName}}
                </a>
            </div>
            <div class="col-6"></div>
        </div>
    @endforeach
@endif