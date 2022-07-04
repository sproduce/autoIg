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
            'dateFinish' => 'required',
            'timeFinish' => 'required',
            'sum' => 'array',
        ];
    }
}
