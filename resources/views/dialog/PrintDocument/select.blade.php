    <div class="modal-header text-center">
        <h6 class="modal-title w-100 font-weight-bold">Документы для печати</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="container-fluid">
            @forelse($printDocuments as $printDocument)
                <div class="row">
                    <div class="col-md-8">
                        {{$printDocument->info}}
                    </div>
                    <div class="col-md-4 text-right">
                        <a title="Печать" href="/printDocument/generation/{{$printDocument->id}}?contractId={{$contractId}}" class="btn btn-ssm btn-outline-success "><i class="fas fa-print"></i></a>
                    </div>
                </div>
            @empty
                Шаблоны не добавлены
           @endforelse
        </div>
    </div>

    <div class="modal-footer d-flex justify-content-center">

    </div>
</form>
 