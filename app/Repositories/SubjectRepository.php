<?php

namespace App\Repositories;
use App\Http\Requests\Search\SearchSubjectRequest;
use App\Models\rentSubject;
use App\Models\rentSubjectContact;
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
        return rentSubject::query()->orderBy('nickname')->get();
    }

    public function getSubjectsCarOwner()
    {
        return rentSubject::whereNotNull('carOwner')->get();
    }


    public function addSubjectContact(rentSubjectContact $subjectContact): rentSubjectContact
    {
        $subjectContact->save();
        return $subjectContact;
    }
    public function getSubjectContacts($subjectId)
    {
        return rentSubjectContact::where('subjectId',$subjectId)->get();
    }


    public function delSubjectContact($contactId)
    {
        // TODO: Implement delSubjectContact() method.
    }

    public function delSubjectContacts($subjectId)
    {
        rentSubjectContact::where('subjectId',$subjectId)->delete();
    }

    public function getLastSubjects($kol)
    {
        return rentSubject::take($kol)->orderByDesc('id')->get();
    }

    public function searchSubject(SearchSubjectRequest $subjectSearch)
    {
        $text = $subjectSearch->get('searchText');
        $rentSubjectQuery = rentSubject::query()
            ->where('surname','LIKE','%'.$text.'%')
            ->orWhere('name','LIKE','%'.$text.'%')
            ->orWhere('companyName','LIKE','%'.$text.'%')
            ->orWhere('nickName','LIKE','%'.$text.'%');
        return $rentSubjectQuery->get();
    }


}
