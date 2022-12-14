<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class FineRequest extends FormRequest
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

        if (!isset($input['childAllow'])){
            $this->merge(['childAllow' => 0]);
        }
        $dateTime = date("Y-m-d H:i:00",strtotime($input['dateFine'].' '.$input['timeFine']));
        $this->merge(['dateTimeFine' => $dateTime,]);
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
            'dateOrder' => 'date|required',
            'dateFine' => 'date|required',
            'timeFine' => 'date_format:H:i|required',
            'uin' => 'string|required',
            'datePaySale' => 'date|nullable',
            'datePayMax' => 'date|nullable',
            'sumSale' => 'integer|required',
            'sum' => 'integer|required',
            'comment' => 'string|nullable',
            'dateTimeFine' => 'required',
            'parentId' => 'integer|nullable',
            'childAllow' => 'boolean|nullable',
        ];
    }
}
