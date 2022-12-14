<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class DocumentTitleRequest extends FormRequest
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
     *  set default value sumSale and sum
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $input = parent::all();

        if (!isset($input['regNumber'])){
            $this->merge(['regNumber' => "X000XX000"]);
        }
        
        if (!isset($input['sum'])){
            $this->merge(['sum' => 0]);
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
            'id' => 'integer|nullable',
            'parentId' => 'integer|nullable',
            'carId' => 'integer|required',
            'subjectId' => 'integer|required',
            'ownerSubjectId' => 'integer|required',
            'date' => 'date|required',
            'dateDocument' => 'date|required',
            'sum' => 'integer|nullable',
            'regNumber' => 'string|required',
            'number' => 'string|nullable',
            'issued' => 'string|nullable',
            'marks' => 'string|nullable',
            'color' => 'string|nullable',
            'comment' => 'string|nullable',
        ];
    }
}
