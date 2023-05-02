<div class="row row-table">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-1">
                                    <a href="/rentEvent/{{$insurance->eventId}}/{{$insurance->dataId}}" class="btn btn-ssm btn-outline-info DialogUser" title="Подробнее"><i class="fas fa-info-circle"></i></a>
                                    <strong>Дата</strong>
                                </div>
                                <div class="col-3 p-0">{{$insurance->eventModel->dateDocumentText}} по {{$insurance->eventModel->expirationText}}</div>
                                <div class="col-1"><strong>Субьект</strong></div>
                                <div class="col-2 p-0">{{$insurance->eventModel->subject->nickname}}</div>
                                <div class="col-1"><strong>Субьект</strong></div>
                                <div class="col-2 p-0">{{$insurance->eventModel->subjectTo->nickname}}</div>
                                <div class="col-1"></div>
                                <div class="col-1">
                                    <a href="/file/fileInfoDialog/{{$insurance->uuid}}" class="btn btn-ssm @if($insurance->files->count())btn-outline-primary @else btn-outline-secondary @endif DialogUser"> <i class="fas fa-folder-open"></i></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Номер</strong></div>
                                <div class="col-2">{{$insurance->eventModel->number}}</div>
                                <div class="col-1"><strong>Сумма</strong></div>
                                <div class="col-1">{{$insurance->toPayment->sum}}</div>
                                <div class="col-2"><strong>Особые отметки</strong></div>
                                <div class="col-2">{{$insurance->eventModel->marks}}</div>
                            </div>
                            <div class="row">
                                <div class="col-1"><strong>Комментарий</strong></div>
                                <div class="col-11">{{$insurance->comment}}</div>
                            </div>
                        </div>
                    </div>