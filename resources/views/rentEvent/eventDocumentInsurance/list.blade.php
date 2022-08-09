@if($listEventsObj->count())

    <div class="row align-items-center font-weight-bold border">
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
    @foreach($listEventsObj as $event)

    @endforeach

@endif
