<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarIdRequest extends FormRequest
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


    public function getCarId()
    {
        $input = parent::all(['carId']);
        return $input['carId'];
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'carId'=>'required|integer',
        ];
    }
}
