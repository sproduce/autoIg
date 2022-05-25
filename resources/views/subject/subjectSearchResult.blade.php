@foreach($subjectsObj as $subject)
    <div class="row row-table">
        <div class="col-6">{{$subject->nickname}}</div>
        <div class="col-4"></div>
        <div class="col-2">
            <button class="btn btn-ssm btn-outline-success subjectSearch" data-subjectSeachText="{{$subject->nickname}}" data-subjectSearchId="{{$subject->id}}">
                <i class="fas fa-user-plus" ></i>
            </button>
        </div>
    </div>
@endforeach
