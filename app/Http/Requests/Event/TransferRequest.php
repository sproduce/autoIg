<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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

        $dateTime = date("Y-m-d H:i:00",strtotime($input['dateTransfer'].' '.$input['timeTransfer']));
        $this->merge(['dateTimeTransfer' => $dateTime,]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'carId' => 'integer|required',
            'mileage' => 'integer|nullable',
            'typeTransfer' => 'integer|required',
            'commentTransfer' => 'string|nullable',
            'dateTransfer' => 'date|required',
            'timeTransfer' => 'date_format:H:i|required',
            'dateTimeTransfer' => 'required',
        ];
    }
}
