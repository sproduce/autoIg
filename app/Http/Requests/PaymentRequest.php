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
            'dateTime'=>'required',
            'payment'=>'required|integer',
            'comm'=>'required|integer',
            'payAccountId'=>'required|integer',
            'payOperationTypeId'=>'required|integer',
            'name'=>'',
            'carId'=>'',
            'carGroupId'=>'',
            'finished'=>'',
            'pid'=>'integer|nullable',
            'comment'=>'',
            'contractId'=>'',
            'subjectId'=>'',
        ];
    }
}
