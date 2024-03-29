<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class EventListRequest extends FormRequest
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
            'eventId' => 'array|nullable',
            'eventId.*' => 'integer|min:1',
            'carId' => 'array|nullable',
            'carId.*' => 'integer|min:1',
            'contractId' => 'integer|nullable',
            'delete' => '',
        ];
    }
}
