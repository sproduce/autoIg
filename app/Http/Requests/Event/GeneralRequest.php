<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class GeneralRequest extends FormRequest
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
            'contractId' => 'integer|nullable',
            'sum' => 'integer|required',
            'date' => 'date|required',
            'time' => 'date_format:H:i|required',
            'comment' => 'string|nullable',
            'dateTime' => 'required',
        ];
    }
}
