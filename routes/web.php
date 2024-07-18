<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\DueController;

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

Auth::routes();

Route::resource('/main', MainController::class);
Route::resource('/validate', ValidateController::class);
Route::resource('/due_date', DueController::class);

Route::resource('/index', FrontController::class);
Route::get('/index/cetak_pdf/{surat_tagihan}', [FrontController::class, 'cetakPdf'])->name('index.cetak_pdf');
// Route::get('/print-invoice/{surat_tagihan}', 'App\Http\Controllers\FrontController@printInvoice')->name('print_invoice');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
