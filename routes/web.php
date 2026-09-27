<?php

use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\KaryawanController;
    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AdminPasswordResetController;

    // Alur Pengguna / Karyawan (Mobile View)
    Route::get('/', [AuthController::class, 'index'])->name('welcome');
    // Tampil form login
    Route::get('/login-karyawan', [KaryawanController::class, 'showLoginForm'])->name('karyawan.login.form');
    Route::post('/login-karyawan', [KaryawanController::class, 'loginProses'])->name('karyawan.login');
    // Route untuk Beralih Mode Tampilan Welcome (Karyawan <-> Ahli Waris)
    Route::get('/switch.mode/{mode}', function ($mode) {
        if ($mode === 'ahli-waris') {
            session(['is_ahli_waris_mode' => true]);
        } else {
            session()->forget('is_ahli_waris_mode');
        }
        return redirect()->route('welcome');
    })->name('switch.mode');
    Route::get('/panduan', [KaryawanController::class, 'panduan'])->name('panduan');

    Route::middleware(['web'])->group(function () {
        // 1. REGISTRASI WAJAH MANDIRI (PERTAMA KALI)
        Route::get('/karyawan/registrasi-wajah', [KaryawanController::class, 'registrasiForm'])->name('karyawan.registrasi');
        Route::post('/karyawan/registrasi-wajah/store', [KaryawanController::class, 'storeRegistrasi'])->name('karyawan.registrasi.store');

        // 2. BERANDA & MENU UTAMA
        Route::get('/karyawan/beranda', [KaryawanController::class, 'beranda'])->name('karyawan.beranda');
        Route::get('/karyawan/info', [KaryawanController::class, 'info'])->name('karyawan.info');
        Route::get('/karyawan/riwayat', [KaryawanController::class, 'riwayat'])->name('karyawan.riwayat');
        Route::get('/karyawan/ahli-waris', [KaryawanController::class, 'beralihAhliWarisForm'])->name('karyawan.beralih.form');
        Route::post('/karyawan/ahli-waris', [KaryawanController::class, 'prosesBeralihAhliWaris'])->name('karyawan.beralih.proses');
        Route::get('/karyawan/ahli-waris/regis', [KaryawanController::class, 'regisAhliWarisForm'])->name('karyawan.beralih.regis');
        Route::post('/karyawan/ahli-waris/regis/store', [KaryawanController::class, 'storeRegisAhliWaris'])->name('karyawan.beralih.regis.store');
        Route::match(['get', 'post'], '/karyawan/logout', [KaryawanController::class, 'logout'])->name('karyawan.logout');

        // 3. ABSENSI SCAN WAJAH HARIAN
        Route::get('/karyawan/scan', [KaryawanController::class, 'scan'])->name('karyawan.scan');
        Route::post('/karyawan/scan-store', [KaryawanController::class, 'storeScan'])->name('karyawan.scan.store');
        Route::get('/karyawan/berhasil', [KaryawanController::class, 'success'])->name('karyawan.success');
    });

    // Alur Admin (Web Dashboard View)
    Route::get('/admin/login', [AuthController::class, 'showLoginAdmin'])->name('admin.login.form');
    Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');
    Route::get('/admin/forgot-password', [AdminPasswordResetController::class, 'showForgotForm'])->name('admin.password.request');
    Route::post('/admin/forgot-password', [AdminPasswordResetController::class, 'sendResetLink'])->name('admin.password.email');
    Route::get('/admin/reset-password/{token}', [AdminPasswordResetController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('/admin/reset-password', [AdminPasswordResetController::class, 'updatePassword'])->name('admin.password.update');

    Route::middleware(['auth'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/rekap', [AdminController::class, 'rekap'])->name('admin.rekap');
        Route::get('/cetak-absensi', [AdminController::class, 'cetakLaporan'])->name('admin.cetak');
        Route::get('/kelola-data', [AdminController::class, 'editData'])->name('admin.edit');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
        Route::get('/karyawan', [AdminController::class, 'dataKaryawan'])->name('admin.karyawan');
        Route::post('/karyawan/{id}/reset-wajah', [AdminController::class, 'resetWajah'])->name('admin.karyawan.reset_wajah');
        Route::patch('/karyawan/{id}/tipe', [AdminController::class, 'updateTipe'])->name('admin.karyawan.updateTipe');

        Route::get('/admin/export-excel', [AdminController::class, 'exportExcel'])->name('admin.export.excel');
        Route::get('/admin/export-pdf', [AdminController::class, 'exportPdf'])->name('admin.export.pdf');
        Route::get('/admin/karyawan/export-excel', [AdminController::class, 'exportKaryawanExcel'])->name('admin.karyawan.export_excel');
        Route::post('/admin/karyawan/import-excel', [AdminController::class, 'importKaryawanExcel'])->name('admin.karyawan.import_excel');
        Route::get('/admin/karyawan/download-template', [AdminController::class, 'downloadTemplateExcel'])->name('admin.karyawan.download_template');
        Route::post('/admin/karyawan/{id}/update', [AdminController::class, 'updateKaryawan'])->name('admin.karyawan.update');
        Route::get('/cetak-individual/{id}', [AdminController::class, 'cetakIndividual'])->name('admin.cetak.individual');
        Route::post('/karyawan/store', [AdminController::class, 'storeKaryawan'])->name('admin.karyawan.store');
        Route::delete('/karyawan/{id}/delete', [AdminController::class, 'destroyKaryawan'])->name('admin.karyawan.delete');
    });
