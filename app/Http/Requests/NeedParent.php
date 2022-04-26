<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeedParent extends FormRequest
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
        $input = parent::all();
        if (empty($input['needParent'])) {
            $this->merge(['needParent' => 0]);
        }
    }




    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'needParent' => 'boolean|required',
        ];
    }
}
