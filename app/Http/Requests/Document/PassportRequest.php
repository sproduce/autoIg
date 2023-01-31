<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class PassportRequest extends FormRequest
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
            'linkUuid' => '',
            'number' => '',
            'issuedBy' => '',
            'dateIssued' => '',
            'birthplace' => '',
            'placeResidence' => '',
            'dateResidence' => '',
            'actual' => '',
        ];
    }
}
