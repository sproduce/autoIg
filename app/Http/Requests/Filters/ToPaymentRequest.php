<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class ToPaymentRequest extends FormRequest
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
            'carId' => 'integer|nullable',
            'eventId' => 'integer|nullable',
            'subjectFromId' => 'integer|nullable',
            'subjectToId' => 'integer|nullable',
        ];
    }
}
