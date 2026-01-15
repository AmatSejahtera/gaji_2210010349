<?php

use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JabatanKaryawanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('pengguna', UserController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('jabatan-karyawan', JabatanKaryawanController::class);
    Route::get('print-pdf', [JabatanController::class, 'printPdf'])->name('print.jabatan');
    Route::get('grafik-jabatan', [JabatanController::class, 'grafikJabatan'])->name('grafik.jabatan');
    Route::get('get-grafik', [JabatanController::class, 'getGrafik'])->name('get.grafik.jabatan');
    Route::get('export-excel', [JabatanController::class, 'exportExcel'])->name('export.excel');
    //
});
