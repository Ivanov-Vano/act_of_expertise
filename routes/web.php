<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActController;

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

Route::get('/', [ActController::class, 'index'])->name('index');
Route::get('/{id}/show', [ActController::class, 'show'])->name('show');
Route::get('/{id}/word-export', [ActController::class, 'wordExport'])->name('word.export');

//Route::post('download/docx',[ReportController::class, 'downloadDocx'])->name('download.docx');
