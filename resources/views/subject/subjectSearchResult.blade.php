@foreach($subjectsObj as $subject)
    <div class="row row-table">
        @if ($subject->companyName)
            @if (is_null($subject->individual))
                <div class="col-2">
                 <strong>Организация</strong>
                </div>
                <div class="col-4">
            @else
                <div class="col-6">
            @endif
                {{$subject->companyName}}
            </div>
        @else
            <div class="col-3">{{$subject->surname}}</div>
            <div class="col-3">{{$subject->name}}</div>
        @endif
        <div class="col-3">{{$subject->nickname}}</div>
        <div class="col-1">
            <button class="btn btn-ssm btn-outline-success subjectSearch" data-subjectSearchText="{{$subject->surname}} {{$subject->name}} {{$subject->nickname}}" data-subjectSearchId="{{$subject->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
