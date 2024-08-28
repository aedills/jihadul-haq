<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\QurbanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/user/home');
});

Route::get('/dashboard/{range?}', [AdminController::class, 'index'])->name('dashboard');

// Login
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/log1n', [AuthController::class, 'log1n'])->name('log1n');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/do', [AuthController::class, 'doLogin'])->name('doLogin');


// Admin
Route::prefix('adminn')->name('admin.')->group(function () {

    // Manajemen User
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::post('/store', [AdminUserController::class, 'store'])->name('store');
        Route::post('/update', [AdminUserController::class, 'update'])->name('update');
        Route::post('/delete', [AdminUserController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('edit');
    });

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

        // Income
        Route::post('/storeIn', [KeuanganController::class, 'storeIn'])->name('storeIn');
        Route::post('/updateIn', [KeuanganController::class, 'updateIn'])->name('updateIn');
        Route::post('/deleteIn', [KeuanganController::class, 'deleteIn'])->name('deleteIn');

        // Outcome
        Route::post('/storeOut', [KeuanganController::class, 'storeOut'])->name('storeOut');
        Route::post('/updateOut', [KeuanganController::class, 'updateOut'])->name('updateOut');
        Route::post('/deleteOut', [KeuanganController::class, 'deleteOut'])->name('deleteOut');

        Route::get('/pending', [KeuanganController::class, 'pending'])->name('pending');
        Route::get('/pending/approve/{id}', [KeuanganController::class, 'pendingApprove'])->name('pending.approve');
    });

    // Jamaah
    Route::prefix('jamaah')->name('jamaah.')->group(function () {
        Route::get('/', [JamaahController::class, 'index'])->name('index');
        Route::post('/store', [JamaahController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [JamaahController::class, 'edit'])->name('edit');
        Route::post('/update', [JamaahController::class, 'update'])->name('update');
        Route::post('/delete', [JamaahController::class, 'delete'])->name('delete');
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

// User
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/home/{range?}', [UserController::class, 'home'])->name('home');

    Route::get('/qurban', [UserController::class, 'qurban'])->name('qurban');
    Route::get('/qurban/{id}', [UserController::class, 'qurbanDetail'])->name('qurban.detail');

    Route::get('/kegiatan', [UserController::class, 'kegiatan'])->name('kegiatan');

    Route::get('/keuangan', [UserController::class, 'keuangan'])->name('keuangan');

    Route::get('/jamaah', [UserController::class, 'jamaah'])->name('jamaah');

    Route::get('/pass', [UserController::class, 'pass'])->name('pass');
    Route::post('/cpass', [UserController::class, 'cpass'])->name('cpass');
});
