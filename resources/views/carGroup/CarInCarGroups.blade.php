@extends('../adminIndex')


@section('header')
<h6 class="m-0"><a class="btn btn-ssm btn-outline-success DialogUserMin mr-3" title="Добавить машину в группу" href="/carGroup/addCarInCarGroupDialog?carId={{$carObj->id}}"><i class="far fa-plus-square"></i></a> Машина <strong>{{$carObj->nickName}}</strong> в группах</h6>
@endsection

@section('content')


    <div class="row align-items-center font-weight-bold border">
        <div class="col-3">
            Группа
        </div>
        <div class="col-2">
            NickName
        </div>
        <div class="col-2">
            Добавлена
        </div>
        <div class="col-2">
            Удалена
        </div>

        <div class="col-2">

        </div>
    </div>
   

    @forelse($carGroups as $carGroup)
        <div class="row">
            <div class="col-3">
               {{$carGroup->name}}
            </div>
            <div class="col-2">
               {{$carGroup->nickName}}
            </div>
            <div class="col-2">
                 {{$carGroup->start}}
            </div>
            <div class="col-2">
                {{$carGroup->finish}}
            </div>
        </div>
    @empty
        <strong> Машина в группы не добавлена</strong>
    @endforelse



@endsection

@section ('js')

@endsection



