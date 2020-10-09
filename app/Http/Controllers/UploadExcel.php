<?php

namespace App\Http\Controllers;

use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UploadExcel extends Controller
{
    protected $delimiter = ";";

    function excel(Request $request)
    {
        $file = $request->file;

        // dd($file);

        Excel::import(new ExcelImport, $file);

        echo "Success!";
    }
}
