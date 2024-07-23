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

        Route::post('/storeIn', [KeuanganController::class, 'storeIn'])->name('storeIn');
        Route::post('/storeOut', [KeuanganController::class, 'storeOut'])->name('storeOut');
    });

    // Jamaah
    Route::prefix('jamaah')->name('jamaah.')->group(function () {
        Route::get('/', [JamaahController::class, 'index'])->name('index');
    });

    // Qurban
    Route::prefix('qurban')->name('qurban.')->group(function () {
        Route::get('/', [QurbanController::class, 'index'])->name('index');
        Route::post('/store', [QurbanController::class, 'store'])->name('store');
        Route::post('/update', [QurbanController::class, 'update'])->name('update');
        Route::post('/delete', [QurbanController::class, 'delete'])->name('delete');

        Route::get('/detail/{id}', [QurbanController::class, 'detail'])->name('detail');
        Route::post('/detail/create', [QurbanController::class, 'detailCreate'])->name('detail.create');
        Route::post('/detail/update', [QurbanController::class, 'detailUpdate'])->name('detail.update');
        Route::post('/detail/delete', [QurbanController::class, 'detailDelete'])->name('detail.delete');
    });
});
