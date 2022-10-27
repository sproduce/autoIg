<?php

namespace App\Imports;

use App\Models\rentEventFine;

use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Illuminate\Support\Collection;

class FineImport implements  WithValidation, SkipsOnFailure,ToCollection
{
    use Importable, SkipsFailures;

    public function rules(): array
    {
        return [
            '3' => 'integer',
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new rentEventFine([
            'sum' => $row[3],
        ]);
    }


    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.3' => 'integer',
         ])->validate();
        $collection = collect(['name', 'age']);
//        foreach ($rows as $row)
//        {
//            rentEventFine::create([
//                'sum' => $row[3],
//            ]);
//        }

return $collection;
    }



}
