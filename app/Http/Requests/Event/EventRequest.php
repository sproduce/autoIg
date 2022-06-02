<?php

namespace App\Http\Requests\Event;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
        if (empty($input['date'])){
            $date = Carbon::today();
        } else{
            $date = new Carbon($input['date']);
        }
        $date = $date->setTimeFrom(Carbon::now());
        $this->merge(['date' => $date]);
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'carId' => 'nullable|integer',
            'contractId' => 'nullable|integer',
            'date' => 'nullable|date',
        ];
    }
}
