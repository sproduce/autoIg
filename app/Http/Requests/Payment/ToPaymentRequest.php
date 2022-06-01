<?php

namespace App\Http\Requests\Payment;

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
            'id' => 'integer|nullable',
            'timeSheetId' => 'integer|nullable',
            'paymentId' => 'integer|nullable',
            'contractId' => 'integer|required',
            'sum' => 'integer|required',
            'comment' => 'string|nullable',
        ];
    }
}
