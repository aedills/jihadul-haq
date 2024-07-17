<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\QurbanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');

Route::prefix('adminn')->name('admin.')->group(function () {
    
    // Kegiatan
    Route::prefix('kegiatan')->name('kegiatan.')->group(function () {
        Route::get('/', [KegiatanController::class, 'index'])->name('index');
        Route::post('/store', [KegiatanController::class, 'store'])->name('store');
        Route::get('/edit', [KegiatanController::class, 'edit'])->name('edit');
        Route::post('/update', [KegiatanController::class, 'update'])->name('update');
        Route::post('/delete', [KegiatanController::class, 'delete'])->name('delete');
    });

    // Keuangan
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('index');
    });

    // Jamaah
    Route::prefix('jamaah')->name('jamaah.')->group(function () {
        Route::get('/', [JamaahController::class, 'index'])->name('index');
    });

    // Qurban
    Route::prefix('qurban')->name('qurban.')->group(function () {
        Route::get('/', [QurbanController::class, 'index'])->name('index');
    });
});
