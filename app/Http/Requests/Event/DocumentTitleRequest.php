<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTitleRequest extends FormRequest
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
            'date' => 'date|required',
            'sum' => 'integer|nullable',
            'regNumber' => 'string|nullable',
            'number' => 'string|nullable',
            'issued' => 'string|nullable',
            'marks' => 'string|nullable',
            'color' => 'string|nullable',
            'comment' => 'string|nullable',
        ];
    }
}
