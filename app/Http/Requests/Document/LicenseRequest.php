<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class LicenseRequest extends FormRequest
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
            'id' => '',
            'number' => '',
            'city' => '',
            'issuedBy' => '',
            'start' => '',
            'finish' => '',
            'categories' => '',
            'actual' => '',
        ];
    }
}
