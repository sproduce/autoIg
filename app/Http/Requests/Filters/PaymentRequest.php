<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'accountId' => 'integer|nullable',
            'operationTypeId' => 'integer|nullable',
            'subjectId' => 'integer|nullable',
            'carId' => 'integer|nullable',
            'carGroupId' => 'integer|nullable',
        ];
    }
}
