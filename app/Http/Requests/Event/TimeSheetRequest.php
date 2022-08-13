<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class TimeSheetRequest extends FormRequest
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

    protected function prepareForValidation(): void
    {
        $input = parent::all();
        if (!$input['parentId']){
            $this->merge(['parentId' => null]);
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
            'parentId' => 'integer|nullable',
        ];
    }
}
