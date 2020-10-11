<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contacts', 'App\Http\Controllers\UploadExcel@index')->name('contacts');
Route::post('/csvToArray', 'App\Http\Controllers\UploadExcel@load')->name('load');
Route::post('/excelSubmit', 'App\Http\Controllers\UploadExcel@excel')->name('excel');
