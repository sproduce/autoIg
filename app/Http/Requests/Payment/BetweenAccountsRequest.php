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


    protected function prepareForValidation()
    {
        $input = parent::all(['commFrom','commTo']);

        if (empty($input['commFrom'])){
            $this->merge(['commFrom' => 0]);
        }
        if (empty($input['commTo'])){
            $this->merge(['commTo' => 0]);
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
           'dateTime' => 'date|required',
           'payment' => 'integer|required',
           'commFrom' => 'integer|required',
           'commTo' => 'integer|required',
           'payAccountIdFrom' => 'integer|required|different:payAccountIdTo',
           'payAccountIdTo' => 'integer|required',
           'carGroupId' => 'integer|nullable',
           'comment' => 'string|nullable',
        ];
    }
}
