<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use App\Models\Podaci;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcel extends Controller
{
    public function index()
    {
        $data = Podaci::latest()->paginate(2);

        return view('index', ['data' => $data]);
    }

    public function load(Request $request)
    {
        $file = $request->file;

        if ($request->input('action') == 1) {

            if ($file) {
                $location = 'uploads';

                $filename = $file->getClientOriginalName();
                $file->move($location, $filename);
                $filepath = public_path($location . "/" . $filename);

                $csv = array_map('str_getcsv', file($filepath));

                $dataArray = array();
                $badInputs = array();

                foreach ($csv as $data) {
                    $data = explode(';', $data[0]);

                    $duplicate = DB::table('podaci')
                        ->where('ime', $data[0])
                        ->where('prezime', $data[1])
                        ->where('postanski_br', $data[2])
                        ->where('grad', $data[3])
                        ->where('telefon', $data[4])->get();

                    if (preg_match('/[A-Za-z].*[0-9]|[0-9].*[A-Za-z]/', $data[2]) || $duplicate->count() > 0) {
                        array_push($badInputs, $data);
                    } else {
                        array_push($dataArray, $data);
                    }
                }

                return view('loaded', ['data' => $dataArray, 'bad_inputs' => $badInputs]);
            } else {
                return redirect('/')->with('badreq', 'Niste odabrali datoteku.');
            }
        } else {
            if ($file) {
                Excel::import(new ExcelImport, $file);

                return redirect('/')->with('mssg', 'Podaci spremljeni');
            } else {
                return redirect('/')->with('badreq', 'Niste odabrali datoteku.');
            }
        }
    }

    public function excel(Request $request)
    {
        $file = $request->file;

        if ($file) {
            Excel::import(new ExcelImport, $file);

            return redirect('/')->with('mssg', 'Podaci spremljeni');
        } else {
            return redirect('/')->with('badreq', 'Niste odabrali datoteku.');
        }
    }
}
