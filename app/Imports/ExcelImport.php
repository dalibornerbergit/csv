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
        $missingField = false;
        $invalidField = false;

        foreach ($collection as $value) {

            $data = explode(';', $value[0]);

            if (!$data[0] || !$data[1] || !$data[2] || !$data[3] || !$data[4])
                $missingField = true;

            if (
                preg_match('/[0-9]/', $data[0]) ||
                preg_match('/[0-9]/', $data[1]) ||
                !preg_match('/^\d+$/', $data[2]) ||
                preg_match('/[0-9]/', $data[3]) ||
                preg_match('/[a-zA-z]/', $data[4])
            ) {
                $invalidField = true;
            }

            $duplicate = DB::table('podaci')
                ->where('ime', $data[0])
                ->where('prezime', $data[1])
                ->where('postanski_br', $data[2])
                ->where('grad', $data[3])
                ->where('telefon', $data[4])->get();

            if ($duplicate->count() > 0 || $invalidField || $missingField) {
                array_push($badInputs, $data);
                $missingField = false;
                $invalidField = false;
            } else {
                DB::table('podaci')->insert(['ime' => $data[0], 'prezime' => $data[1], 'postanski_br' => $data[2], 'grad' => $data[3], 'telefon' => $data[4]]);
            }
        }
    }
}
