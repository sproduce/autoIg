<?php

namespace App\Http\Requests;

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
            'id' => 'nullable|integer',
            'dateTime' => 'required',
            'payment' => 'required|integer',
            'comm' => 'required|integer',
            'payAccountId' => 'required|integer',
            'payOperationTypeId' => 'nullable|integer',
            'name' => '',
            'carId' => 'nullable|integer',
            'carGroupId' => 'nullable|integer',
            'finished' => 'boolean',
            'isNext' => 'boolean',
            'pid' => 'integer|nullable',
            'comment' => '',
            'contractId' => 'nullable|integer',
            'subjectId' => 'nullable|integer',
        ];
    }
}
