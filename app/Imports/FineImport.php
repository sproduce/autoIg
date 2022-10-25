<?php

namespace App\Imports;

use App\Models\rentEventFine;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class FineImport implements  ToModel
{
    use Importable;

    public function rules(): array
    {
        return [
            'sum' => [
                'required',
                'integer',
            ],
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

        foreach ($rows as $row)
        {
            rentEventFine::create([
                'sum' => $row[3],
            ]);
        }
    }



}
