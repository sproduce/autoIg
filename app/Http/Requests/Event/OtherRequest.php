<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class OtherRequest extends FormRequest
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
        if (!$input['sumOther']){
            $this->merge(['sumOther' => 0,]);
        }
        $dateTime = date("Y-m-d H:i:00",strtotime($input['dateOther'].' '.$input['timeOther']));
        $this->merge(['dateTimeOther' => $dateTime,]);
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
            'sumOther' => 'integer',
            'dateOther' => 'date|required',
            'timeOther' => 'date_format:H:i|required',
            'commentOther' => 'string|nullable',
            'dateTimeOther' => ''
        ];
    }
}
