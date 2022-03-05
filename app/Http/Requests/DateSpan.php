<?php

namespace App\Http\Requests;

use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
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
        $input=parent::all(['fromDate','toDate']);

        if (empty($input['fromDate'])||empty($input['toDate'])){
            $toDate=CarbonImmutable::today();
            $fromDate=$toDate->subMonth(1);
            $this->merge(['fromDate'=>$fromDate->format('Y-m-d'),
                'toDate'=>$toDate->format('Y-m-d')]
            );
        }

    }

    public function getCarbonPeriod(): CarbonPeriod
    {
        $input=parent::all(['fromDate','toDate']);
        $periodDate=new CarbonPeriod($input['fromDate'],$input['toDate']);
        return  $periodDate;
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
