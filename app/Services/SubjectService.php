<?php
namespace App\Services;
use App\Http\Requests\SubjectRequest;
use App\Models\rentSubject;
use App\Models\rentSubjectRegion;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;

Class SubjectService{

    private $subjectRep,$subjectModel;

    function __construct(SubjectRepositoryInterface $subjectRep,rentSubject $subjectModel)
    {
        $this->subjectRep = $subjectRep;
        $this->subjectModel = $subjectModel;
    }


    public function getSubjects()
    {
        return $this->subjectRep->getSubjects();
    }

    public function addSubject(SubjectRequest $subjectReq)
    {
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


}
