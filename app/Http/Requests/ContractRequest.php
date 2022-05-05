<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
        $input=parent::all();
        if (!isset($input['balance'])){
            $this->merge(['balance' => 0]);
        }
        if (!isset($input['deposit'])){
            $this->merge(['deposit' => 0]);
        }
        if (!isset($input['price'])){
            $this->merge(['price' => 0]);
        }
        if (!isset($input['sum'])){
            $this->merge(['sum' => 0]);
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
            'id' => 'integer|nullable',
            'start' => 'required',
            'finish' => '',
            'finishFact' => '',
            'typeId' => 'required|integer',
            'driverId' => 'integer|nullable',
            'carGroupId' => 'integer|nullable',
            'carId' => 'integer|nullable',
            'statusId' => 'required|integer',
            'balance' => 'integer',
            'deposit' => 'integer',
            'number' => 'required',
            'comment' => 'string|nullable',
            'sum' => 'integer',
            'price' =>'integer',
        ];
    }
}
