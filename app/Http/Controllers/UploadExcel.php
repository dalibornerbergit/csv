<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Podaci;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcel extends Controller
{
    public function index()
    {
        return new Collection(Podaci::get());
    }

    public function load(Request $request)
    {
        $file = $request->file;

        $missingField = false;
        $invalidField = false;
        $location = 'uploads';

        $filename = $file->getClientOriginalName();
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);

        $csv = array_map('str_getcsv', file($filepath));

        $dataArray = array();
        $badInputs = array();

        foreach ($csv as $data) {
            $data = explode(';', $data[0]);

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
                array_push($dataArray, $data);
            }
        }

        return ['data' => $dataArray, 'bad_inputs' => $badInputs];
    }

    public function store(Request $request)
    {
        $file = $request->file;

        Excel::import(new ExcelImport, $file);
    }
}
