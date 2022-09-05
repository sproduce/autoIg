<?php

namespace App\Http\Requests\Filters;

use Illuminate\Foundation\Http\FormRequest;

class ContractToRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subjectFrom' => 'int|nullable',
            'subjectTo' => 'int|nullable',
            'carId' => 'int|nullable',
            'rentTypeId' => 'int|nullable',
        ];
    }
}
