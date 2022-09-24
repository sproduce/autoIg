<?php

namespace App\Http\Requests\Filters;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Foundation\Http\FormRequest;
use League\Flysystem\Config;

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

    protected function prepareForValidation()
    {
        $input = parent::all();
        if (empty($input['carGroupId'])){
            $this->merge(['carGroupId' => null]);
        }

        if (empty($input['currentDate'])){
            $date = CarbonImmutable::today();
        } else{
            $date = new CarbonImmutable($input['currentDate']);
        }
        $date = $date->setTimeFrom(Carbon::now()->startOfDay());
        $this->merge(['currentDate' => $date]);

        if (empty($inpud['subDays'])){
            $this->merge(['subDays' => config('global.timeSheetBefore')]);
        }
        if (empty($inpud['addDays'])){
            $this->merge(['addDays' => config('global.timeSheetAfter')]);
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
            'currentDate' => 'date',
            'subDays' => 'integer',
            'addDays' => 'integer',
            'carGroupId' => 'integer|nullable',
        ];
    }
}
