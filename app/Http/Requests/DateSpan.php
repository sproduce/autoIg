<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;


class DateSpan extends FormRequest
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
        $input=parent::all();
        if (empty($input['fromDate'])||empty($input['toDate'])){
            $fromDate=CarbonImmutable::today();
            $toDate=$fromDate->subMonth(1);
            $this->merge(['fromDate'=>$fromDate->format('Y-m-d'),
                'toDate'=>$toDate->format('Y-m-d')]
            );
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
            'fromDate' => 'date',
            'toDate' => 'date'
        ];
    }
}
