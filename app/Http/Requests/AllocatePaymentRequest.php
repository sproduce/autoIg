<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AllocatePaymentRequest extends FormRequest
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
            'paymentId' => 'required|integer',
            'toPaymentId' => 'required|array',
            'toPaymentId.*' => 'integer',
            'toPaymentSum' => 'required|array',
            'toPaymentSum.*' => 'integer',
        ];
    }
}
