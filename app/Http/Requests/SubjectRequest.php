<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function getSubjectId()
    {
        $input = parent::all(['id']);
        return $input['id'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' =>'',
            'payAccountId' => '',
            'regionId' => '',
            'surname' => '',
            'name' => '',
            'patronymic' => '',
            'companyName' => '',
            'nickname' => '',
            'birthday' => '',
            'comment' => '',
            'male' => '',
            'individual' => '',
            'client' => '',
            'carOwner' => '',
            'accessible' => '',
            'uuid' => '',
            'toAddForm' => '',
        ];
    }
}
