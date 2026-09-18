<?php

use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\KaryawanController;
    use App\Http\Controllers\AdminController;

    // Alur Pengguna / Karyawan (Mobile View)
    Route::get('/', [AuthController::class, 'index'])->name('welcome');
    Route::get('/login-karyawan', [AuthController::class, 'showLoginKaryawan'])->name('karyawan.login.form');
    Route::post('/login-karyawan', [AuthController::class, 'loginKaryawan'])->name('karyawan.login');

    Route::middleware(['web'])->group(function () {
        Route::get('/karyawan/info', [KaryawanController::class, 'info'])->name('karyawan.info');
        Route::get('/karyawan/scan', [KaryawanController::class, 'scan'])->name('karyawan.scan');
        Route::post('/karyawan/scan-store', [KaryawanController::class, 'storeScan'])->name('karyawan.scan.store');
        Route::get('/karyawan/berhasil', [KaryawanController::class, 'success'])->name('karyawan.success');
        Route::get('/karyawan/beranda', [KaryawanController::class, 'beranda'])->name('karyawan.beranda');
    });

    // Alur Admin (Web Dashboard View)
    Route::get('/admin/login', [AuthController::class, 'showLoginAdmin'])->name('admin.login.form');
    Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');

    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/rekap', [AdminController::class, 'rekap'])->name('admin.rekap');
        Route::get('/cetak-laporan', [AdminController::class, 'cetakLaporan'])->name('admin.cetak');
        Route::get('/edit-data', [AdminController::class, 'editData'])->name('admin.edit');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/admin/export-excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
        Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.export.pdf');
        Route::post('/admin/karyawan/{id}/update', [AdminController::class, 'updateKaryawan'])->name('admin.karyawan.update');
    });
