<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\dataController;
use App\Http\Controllers\menghitungController;
use App\Models\data;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');




Route::get('kriteria', [KriteriaController::class, 'index'])->name('kriteria.index');
Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('kriteria.create');
Route::post('kriteria', [KriteriaController::class, 'store'])->name('kriteria.store');
Route::get('kriteria/{id}', [KriteriaController::class, 'show'])->name('kriteria.show');
Route::get('kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');


Route::get('alternatif', [AlternatifController::class, 'index'])->name('alternatif.index');
Route::get('alternatif/create', [AlternatifController::class, 'create'])->name('alternatif.create');
Route::post('alternatif', [AlternatifController::class, 'store'])->name('alternatif.store');
Route::get('alternatif/{alternatif}', [AlternatifController::class, 'show'])->name('alternatif.show');
Route::get('alternatif/{alternatif}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
Route::put('alternatif/{alternatif}', [AlternatifController::class, 'update'])->name('alternatif.update');
Route::delete('alternatif/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');


Route::get('/penilaian', [dataController::class, 'index'])->name('penilaian.index');
Route::get('/penilaian/create', [dataController::class, 'create'])->name('penilaian.create');
Route::post('/penilaian', [dataController::class, 'store'])->name('penilaian.store');
Route::get('/penilaian/{id}/edit', [dataController::class, 'getForms'])->name('penilaian.edit');
Route::put('/penilaian/update', [dataController::class, 'update'])->name('penilaian.update');
Route::delete('/penilaian/{id}', [dataController::class, 'destroy'])->name('penilaian.destroy');

// Routing untuk perhitungan TOPSIS
// Rute untuk metode SAW
Route::get('/perhitungan/saw', [menghitungController::class, 'saw'])->name('perhitungan.saw');


Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
