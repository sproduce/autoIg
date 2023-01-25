<?php
namespace App\Services;
use App\Http\Requests\Search\SearchSubjectRequest;
use App\Http\Requests\SubjectContactRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\payAccount;
use App\Models\rentSubject;
use App\Models\rentSubjectContact;
use App\Models\rentSubjectRegion;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;

Class SubjectService{

    private $subjectRep,$subjectModel,$subjectContactModel,$payAccountModel;

    function __construct(
        SubjectRepositoryInterface $subjectRep,
        rentSubject $subjectModel,
        rentSubjectContact  $subjectContactModel,
        payAccount $payAccountModel
    ){
        $this->subjectRep = $subjectRep;
        $this->subjectModel = $subjectModel;
        $this->subjectContactModel = $subjectContactModel;
    }


    public function getSubjects()
    {
        return $this->subjectRep->getSubjects();
    }

    public function getSubject($subjectId)
    {
        return $this->subjectRep->getSubject($subjectId);
    }

    public function getSubjectContacts($subjectId)
    {
        return $this->subjectRep->getSubjectContacts($subjectId);
    }

        

    public function addSubject(SubjectRequest $subjectReq)
    {
        if ($subjectReq->get('id')){
            $this->subjectModel = $this->subjectRep->getSubject($subjectReq->get('id'));
        }
        $this->subjectModel->payAccountId = $subjectReq->get('payAccountId');
        $this->subjectModel->regionId = $subjectReq->get('regionId');
        $this->subjectModel->surname = $subjectReq->get('surname');
        $this->subjectModel->name = $subjectReq->get('name');
        $this->subjectModel->patronymic = $subjectReq->get('patronymic');
        $this->subjectModel->companyName = $subjectReq->get('companyName');
        $this->subjectModel->nickname = $subjectReq->get('nickname');
        $this->subjectModel->birthday = $subjectReq->get('birthday');
        $this->subjectModel->comment = $subjectReq->get('comment');
        $this->subjectModel->male = $subjectReq->get('male');
        $this->subjectModel->individual = $subjectReq->get('individual');
        $this->subjectModel->client = $subjectReq->get('client');
        $this->subjectModel->carOwner = $subjectReq->get('carOwner');
        $this->subjectModel->accessible = $subjectReq->get('accessible');

        $this->subjectRep->addSubject($this->subjectModel);

    }


    public function addSubjectContact(SubjectContactRequest $subjContactRequest)
    {
        $subjectId = $subjContactRequest->get('subjectId');
        $phoneArray = $subjContactRequest->get('phone');
        $this->subjectRep->delSubjectContacts($subjectId);


        foreach($phoneArray as $phone){
            $subjectModel = new rentSubjectContact();
            $subjectModel->subjectId = $subjectId;
            $subjectModel->phone = $phone;
            $this->subjectRep->addSubjectContact($subjectModel);
        }
    }


    public function getSubjectsCarOwner()
    {
        return $this->subjectRep->getSubjectsCarOwner();
    }


    public function  getLastSubject($kol)
    {
        return $this->subjectRep->getLastSubjects($kol);
    }

    public function search(SearchSubjectRequest $searchSubjectObj)
    {
        return $this->subjectRep->searchSubject($searchSubjectObj);
    }



}
