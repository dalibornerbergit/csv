<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Podaci;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcel extends Controller
{
    public function index()
    {
        $data = Podaci::latest()->get();

        return view('index', ['data' => $data]);
    }

    public function load(Request $request)
    {
        $file = $request->file;
        $location = 'uploads';

        $filename = $file->getClientOriginalName();
        $file->move($location, $filename);
        $filepath = public_path($location . "/" . $filename);

        $csv = array_map('str_getcsv', file($filepath));

        $dataArray = array();

        foreach ($csv as $row) {
            $data = explode(';', $row[0]);

            array_push($dataArray, $data);
        }

        return view('loaded', ['data' => $dataArray]);
    }

    public function excel(Request $request)
    {
        $file = $request->file;

        if ($file) {
            Excel::import(new ExcelImport, $file);

            return redirect('/')->with('mssg', 'Uspijeh.');
        } else {
            return redirect('/')->with('mssg', 'Niste odabrali datoteku.');
        }
    }
}
