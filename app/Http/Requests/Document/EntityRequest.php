<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class EntityRequest extends FormRequest
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
            'actual' => '',
            'fullName' => '',
            'shortName' => '',
            'englishName' => '',
            'address' => '',
            'mailingAddress' => '',
            'phone' => '',
            'ogrn' => '',
            'ogrnip' => '',
            'dateReg' => '',
            'nameReg' => '',
            'director' => '',
            'accountant' => '',
            'okved' => '',
            'okpo' => '',
            'okato' => '',
            'okogu' => '',
            'inn' => '',
        ];
    }
}
