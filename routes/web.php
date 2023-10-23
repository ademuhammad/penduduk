<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendudukController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PendudukController::class,'index'])->name('home');

Route::resource('provinsis', \App\Http\Controllers\ProvinsiController::class);
Route::resource('kabupatens', \App\Http\Controllers\KabupatenController::class);
Route::resource('penduduks', \App\Http\Controllers\PendudukController::class);

Route::post('/get-kabupaten', 'PendudukController@getKabupaten')->name('penduduks.getKabupaten');
Route::get('/get-kabupaten/{id}', 'PendudukController@getKabupaten');


Route::get('/penduduk', 'PendudukController@index');

Route::get('export/penduduk', [App\Http\Controllers\PendudukController::class, 'export']);