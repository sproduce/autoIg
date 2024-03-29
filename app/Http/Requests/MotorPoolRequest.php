<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotorPoolRequest extends FormRequest
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


    protected function prepareForValidation()
    {
        $input = parent::all(['subjectIdFrom','subjectIdOwner']);
        if (empty($input['subjectIdFrom'])){
            $this->merge(['subjectIdFrom' => $input['subjectIdOwner']]);
        }
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable',
            'generationId' => 'required|integer',
            'typeId' => 'integer|required',
            'engineTypeId' => 'integer',
            'transmissionTypeId' => 'integer',
            'year' => 'required',
            'displacement' => 'required|integer',
            'hp' => 'required|integer',
            'vin' => 'required',
            'price' => 'integer|nullable',
            'nickName' => '',
            'subjectIdOwner' => 'required|integer',
            'subjectIdFrom' => 'required|integer',
            'dateStart' => 'required',
            'dateFinish' => '',
            'comment' => '',
        ];
    }
}
