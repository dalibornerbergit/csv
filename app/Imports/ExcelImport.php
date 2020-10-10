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
        $badInputs = array();

        foreach ($collection as $value) {

            $data = explode(';', $value[0]);

            $duplicate = DB::table('podaci')
                ->where('ime', $data[0])
                ->where('prezime', $data[1])
                ->where('postanski_br', $data[2])
                ->where('grad', $data[3])
                ->where('telefon', $data[4])->get();

            if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data[2]) || $duplicate->count() > 0) {
                array_push($badInputs, $data);
            } else {
                DB::table('podaci')->insert(['ime' => $data[0], 'prezime' => $data[1], 'postanski_br' => $data[2], 'grad' => $data[3], 'telefon' => $data[4]]);
            }
        }
    }
}
