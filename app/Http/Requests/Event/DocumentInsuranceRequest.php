<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class DocumentInsuranceRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'integer|nullable',
            'parentId' => 'integer|nullable',
            'carId' => 'integer|required',
            'subjectId' => 'integer|required',
            'subjectToId' => 'integer|required',
            'date' => 'date|required',
            'dateDocument' => 'date|required',
            'expiration' => 'date|required',
            'sum' => 'integer|nullable',
            'number' => 'string|nullable',
            'marks' => 'string|nullable',
            'comment' => 'string|nullable',
        ];
    }
}
