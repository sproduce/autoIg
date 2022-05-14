<?php

namespace App\Http\Controllers;

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

    public function add(rentSubject $subjectObj,rentSubjectRegion $regionModel)
    {
        $regions = $regionModel->all();
        return view('subject.addSubject',['subjectObj' => $subjectObj]);
    }

}
