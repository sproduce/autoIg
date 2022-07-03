<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'carId' => 'integer|nullable',
            'contractId' => 'integer|nullable',
            'subjectId' => 'integer|nullable',
            'sum' => 'integer|required',
            'date' => 'date|required',
            'time' => 'date_format:H:i|required',
            'comment' => 'string|nullable',
        ];
    }
}
