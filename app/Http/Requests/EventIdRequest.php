<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventIdRequest extends FormRequest
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

    public function getEventId()
    {
        $input = parent::all(['eventId']);
        return $input['eventId'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'eventId'=>'integer|nullable',
        ];
    }
}
