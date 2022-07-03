<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        if (empty($input['mileage'])){
            $this->merge(['mileage' => 0]);
        }
        if (empty($input['sum'])){
            $this->merge(['sum' => 0]);
        }

        if (!$input['contractId']){
            $this->merge(['contractId' => NULL]);
        }
        if (!$input['subjectId']){
            $this->merge(['subjectId' => NULL,]);
        }
        $dateTime = date("Y-m-d H:i:00",strtotime($input['date'].' '.$input['time']));
        $this->merge(['dateTime' => $dateTime,]);
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
            'carId' => 'integer',
            'mileage' => 'integer',
            'contractId' => 'integer|nullable',
            'subjectId' => 'integer|nullable',
            'sum' => 'integer',
            'dateTime' => 'required',
            'comment' => 'string|nullable',
        ];
    }
}
