<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AtributController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Data\HomeController as DataHomeController;
use App\Http\Controllers\Data\KriteriaController;
use App\Http\Controllers\NilaiAlternatifController;
use App\Http\Controllers\PendaftarController;
use App\Http\Controllers\PerhitunganController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('login');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'cekLogin'])->name('login.cek');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('user', [AuthController::class, 'userRegister'])->middleware('auth')->name('user.index');
Route::get('user/create', [AuthController::class, 'userRegisterCreate'])->middleware('auth')->name('user.create');
Route::post('user/create', [AuthController::class, 'userRegisterStore'])->middleware('auth')->name('user.store');
Route::delete('user/{id}', [AuthController::class, 'userRegisterDestroy'])->middleware('auth')->name('user.destroy');


Route::prefix('app')->group(function () {
    Route::get('/', function () {
        return redirect()->route('app.index');
    });
    Route::get('home', [DataHomeController::class, 'index'])->name('app.index');
    Route::post('pendaftar/filter', [PendaftarController::class, 'filter'])->name('pendaftar.filter')->middleware('auth');
    Route::post('alternatif/filter', [AlternatifController::class, 'filter'])->name('alternatif.filter')->middleware('auth');
    Route::post('nilai-alternatif/filter', [NilaiAlternatifController::class, 'filter'])->name('nilai-alternatif.filter');
    Route::resources([
        'alternatif' => AlternatifController::class,
        'pendaftar' => PendaftarController::class,
        'kriteria' => KriteriaController::class,
        'atribut' => AtributController::class,
        'nilai-alternatif' => NilaiAlternatifController::class,
    ]);

    Route::post('perhitungan/filter', [PerhitunganController::class, 'filter'])->name('perhitungan.filter');
    Route::get('perhitungan', [PerhitunganController::class, 'index'])->name('perhitungan.index');
});
