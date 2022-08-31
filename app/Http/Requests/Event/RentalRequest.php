<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
        $dateTime = date("Y-m-d H:i:00",strtotime($input['dateStart'].' '.$input['timeStart']));
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
            'carId' => 'integer|required',
            'contractId' => 'required',
            'dateStart' => 'required',
            'timeStart' => 'required',
            'dateTime' => 'required',
            //'sum' => 'integer|nullable',
            'sum' => 'array',
            'sum.*' => 'integer',
            'duration' => 'integer|required|max:1440',
        ];
    }
}
