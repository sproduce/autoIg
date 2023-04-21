@extends('../adminIndex')


@section('header')
<h6 class="m-0">
    <a class="btn btn-ssm btn-outline-success DialogUserMin mr-3" title="Добавить машину в группу" href="/carGroup/addCarInCarGroupDialog?carId={{$carObj->id}}">
        <i class="far fa-plus-square"></i>
    </a> 
    Машина <strong>{{$carObj->nickName}}</strong> владение с {{$carObj->dateStartText}} по {{$carObj->dateFinishText}}    в группах</h6>
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
                 {{$carGroup->linkStart->format('d-m-Y')}}
            </div>
            <div class="col-2">
                @if ($carGroup->linkFinish)
                    {{$carGroup->linkFinish->format('d-m-Y')}}
                @endif
            </div>
            <div class="col-2">
                <a class="btn btn-ssm btn-outline-warning DialogUserSMin" href="/carGroup/editCarInCarGroupDialog/{{$carGroup->carGroupLinkId}}" title="Редактировать"> <i class="far fa-edit"></i></a>
            </div>
        </div>
    @empty
        <strong> Машина в группы не добавлена</strong>
    @endforelse



@endsection

@section ('js')

@endsection



