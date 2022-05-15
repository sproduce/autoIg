<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\payAccount;
use App\Models\rentSubject;
use App\Models\rentSubjectRegion;
use App\Services\SubjectService;

class SubjectController extends Controller
{

    public function show(SubjectService $subjectServ)
    {
        $subjectsObj = $subjectServ->getSubjects();
        return view('subject.subjectList',['subjectsObj' => $subjectsObj]);
    }

    public function add(rentSubject $subjectObj,rentSubjectRegion $regionModel,payAccount $payAccountModel)
    {
        $regionsObj = $regionModel->all();
        $payAccountsObj = $payAccountModel->all();
        return view('subject.addSubject',[
            'subjectObj' => $subjectObj,
            'regionsObj' => $regionsObj,
            'payAccountsObj' => $payAccountsObj,
        ]);
    }


    public function save(SubjectRequest $subjectReq,SubjectService $subjectServ)
    {
        $subjectServ->addSubject($subjectReq);
        return redirect()->back();
    }


}
