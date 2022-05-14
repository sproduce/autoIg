<?php
namespace App\Services;
use App\Models\rentSubjectRegion;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use Illuminate\Http\Request;

Class SubjectService{

    private $subjectRep;

    function __construct(SubjectRepositoryInterface $subjectRep)
    {
        $this->subjectRep = $subjectRep;
    }


    public function getSubjects()
    {
        return $this->subjectRep->getSubjects();
    }

}
