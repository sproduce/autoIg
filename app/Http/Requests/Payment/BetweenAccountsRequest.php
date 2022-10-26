<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;

class BetweenAccountsRequest extends FormRequest
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
           'dateTime' => 'date|required',
           'payment' => 'integer|required',
           'commFrom' => 'integer|required',
           'commTo' => 'integer|required',
           'payAccountIdFrom' => 'integer|required',
           'payAccountIdTo' => 'integer|required',
           'comment' => 'string|nullable',
        ];
    }
}
