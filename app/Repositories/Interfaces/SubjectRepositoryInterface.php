<?php

namespace App\Repositories\Interfaces;
use App\Models\rentSubject;
use App\Models\rentSubjectContact;

interface SubjectRepositoryInterface
{

    public function getSubject($id):rentSubject;
    public function getSubjects();
    public function addSubject(rentSubject $subjectObj):rentSubject;

    public function addSubjectContact(rentSubjectContact $subjectContact):rentSubjectContact;

    public function delSubjectContacts($subjectId);
    public function delSubjectContact($contactId);
    public function getSubjectContacts($subjectId);


}
