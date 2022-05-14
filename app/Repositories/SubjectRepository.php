<?php

namespace App\Repositories;
use App\Models\rentSubject;
use App\Repositories\Interfaces\SubjectRepositoryInterface;


class SubjectRepository implements SubjectRepositoryInterface
{

    public function addSubject(rentSubject $subjectObj): rentSubject
    {
        $subjectObj->save();
        return $subjectObj;
    }

    public function getSubject($id): rentSubject
    {
        return rentSubject::find($id);
    }

    public function getSubjects()
    {
        return rentSubject::all();
    }


}
