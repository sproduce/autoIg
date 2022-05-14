<?php

namespace App\Repositories\Interfaces;
use App\Models\rentSubject;

interface SubjectRepositoryInterface
{

    public function getSubject($id):rentSubject;
    public function getSubjects();
    public function addSubject(rentSubject $subjectObj):rentSubject;

}
