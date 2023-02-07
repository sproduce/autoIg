<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\SearchSubjectRequest;
use App\Http\Requests\SubjectContactRequest;
use App\Http\Requests\SubjectIdRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\payAccount;
use App\Models\rentSubject;
use App\Models\rentSubjectRegion;
use App\Services\SubjectService;

class SubjectController extends Controller
{

    private $subjectServ;
    function __construct(SubjectService $subjectServ)
    {
        $this->subjectServ = $subjectServ;
    }

    public function show()
    {
        $subjectsObj = $this->subjectServ->getSubjects();
        return view('subject.subjectList',['subjectsObj' => $subjectsObj]);
    }

    public function fullInfoDialog($id)
    {
        $subjectObj = $this->subjectServ->getSubject($id);
        $subjectContactsObj = $this->subjectServ->getSubjectContacts($id);
        return view('dialog.Subject.infoSubject',['subjectObj' => $subjectObj,'subjectContactsObj' => $subjectContactsObj]);
    }
    
    
    public function fullInfo($id)
    {
        $subjectObj = $this->subjectServ->getSubject($id);
        $subjectContactsObj = $this->subjectServ->getSubjectContacts($id);
        
        if ($subjectObj->individual){
            $fileView = 'subject.infoIndividual';
        } else {
            $fileView = 'subject.info';
        }
        return view($fileView,['subjectObj' => $subjectObj,'subjectContactsObj' => $subjectContactsObj]);
    }
    
    

    public function add(rentSubject $subjectObj,rentSubjectRegion $regionModel,payAccount $payAccountModel)
    {
        $regionsObj = $regionModel->all();
        $payAccountsObj = $payAccountModel->all();
        $subjectObj->male = 1;
        $subjectObj->individual = 1;
        return view('subject.addSubject',[
            'subjectObj' => $subjectObj,
            'regionsObj' => $regionsObj,
            'payAccountsObj' => $payAccountsObj,
        ]);
    }


    public function addSubjectToDialog($parameter)
    {
        $rentSubjects = $this->subjectServ->getLastSubject(7);
        return view('dialog.Subject.addSubjectTo',['subjectsObj' => $rentSubjects,'parameter' => $parameter]);
    }

    public function addContact($id)
    {
        $subjectContactsObj = $this->subjectServ->getSubjectContacts($id);
        return view('dialog.Subject.addContacts',['subjectId' => $id,'subjectContactsObj' => $subjectContactsObj]);
    }


    public function save(SubjectRequest $subjectReq)
    {
        $this->subjectServ->addSubject($subjectReq);
        
        //return subjecObj
        return redirect('/subject/list');
    }

    public function saveContact(SubjectContactRequest $subjContactRequest)
    {
        $this->subjectServ->addSubjectContact($subjContactRequest);
        return  redirect()->back();
    }


    public function edit(SubjectIdRequest $subjectIdRequest,rentSubjectRegion $regionModel,payAccount $payAccountModel)
    {
        $subjectObj = $this->subjectServ->getSubject($subjectIdRequest->getSubjectId());
        $regionsObj = $regionModel->all();
        $payAccountsObj = $payAccountModel->all();
        return view('subject.addSubject',[
            'subjectObj' => $subjectObj,
            'regionsObj' => $regionsObj,
            'payAccountsObj' => $payAccountsObj,
        ]);
    }

    public function editContact()
    {

    }


    public function delete(SubjectIdRequest $subjectIdRequest)
    {

        return redirect('/subject/list');
    }

    public function deleteContact()
    {

    }


    public function search(SearchSubjectRequest $searchSubjectObj)
    {
        $subjectsObj = $this->subjectServ->search($searchSubjectObj);
        return view('subject.subjectSearchResult',['subjectsObj' => $subjectsObj]);
    }


}
