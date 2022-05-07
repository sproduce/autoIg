<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Http\FormRequest;

class CarIdDate extends FormRequest
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
        if (empty($input['contractId'])){
            $this->merge(['contractId' => null]);
        }

        if (empty($input['date'])){
            $date = CarbonImmutable::today();
        } else{
            $date = new CarbonImmutable($input['date']);
        }
        $date = $date->setTimeFrom(Carbon::now());
        $this->merge(['date' => $date]);

    }

    public function getCarbonPeriodDay(): CarbonPeriod
    {
        $input = parent::all(['date']);
        $periodDate = new CarbonPeriod($input['date']->startOfDay(),$input['date']->addDay(1));
        return  $periodDate;
    }

    public function getCarbonPeriodMonth() :CarbonPeriod
    {
        $input = parent::all(['date']);
        $periodDate = new CarbonPeriod($input['date']->subMonth(1),$input['date']->startOfDay());
        return  $periodDate;
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
            'date' => 'date',
            'contractId' => 'nullable|integer',
        ];
    }
}
