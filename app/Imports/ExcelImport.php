<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        

        foreach ($collection as $value) {

            $data = explode(';', $value[0]);

            DB::table('podaci')->insert(['ime' => $data[0], 'prezime' => $data[1], 'postanski_br' => $data[2], 'grad' => $data[3], 'telefon' => $data[4]]);
        }
    }
}
