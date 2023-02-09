<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrintDocumentRequest extends FormRequest
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
            'id' => 'integer',
            'info' => 'string|required',
            'nickname' => 'string|required',
        ];
    }
}
