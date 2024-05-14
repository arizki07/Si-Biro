<?php
//

use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerPost']);
Route::get('/otp-verification', [AuthController::class, 'otpVerification'])->name('otpVerification');
Route::get('/generate-new-otp', [AuthController::class, 'generateNewOTP'])->name('generateNewOTP');
Route::post('/otp-verification', [AuthController::class, 'otpVerificationPost']);

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Data-Users
    Route::get('/data-users', [DataUserController::class, 'index'])->name('data.users');
    Route::post('/add/users', [DataUserController::class, 'add'])->name('users.add');
    Route::put('users/{user}', [DataUserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}}', [DataUserController::class, 'destroy'])->name('users.destroy');

    //biodata
    Route::get('/data-biodata', [BiodataController::class, 'index'])->name('data.biodata');
    Route::post('/store-biodata', [BiodataController::class, 'store'])->name('store.biodata');
    Route::put('/update/{id}', [BiodataController::class, 'update'])->name('update.biodata');
    Route::delete('/delete/{id}', [BiodataController::class, 'delete'])->name('delete.biodata');

    //transaksi gelap wkwk
    Route::get('/data-transaksi', [TransaksiController::class, 'index'])->name('data.transaksi');
    Route::post('/data-transaksi/store', [TransaksiController::class, 'store'])->name('store.trans');
    Route::put('/data-transaksi/update/{id}', [TransaksiController::class, 'update'])->name('update.trans');
    Route::delete('/data-transaksi/delete/{id}', [TransaksiController::class, 'destroy'])->name('destroy.trans');

    //role
    Route::get('/data-role', [RoleController::class, 'index'])->name('data.role');
    Route::post('/store/role', [RoleController::class, 'store'])->name('store.role');
    Route::post('/update/role/{id}', [RoleController::class, 'update'])->name('update.role');
    Route::delete('/destroy/role/{id}', [RoleController::class, 'destroy'])->name('destroy.role');

    //jadwal
    Route::get('/data-jadwal', [JadwalController::class, 'index'])->name('data.jadwal');
    Route::get('/data-jadwal/delete/{id}', [JadwalController::class, 'destroy'])->name('delete.data.jadwal');
    Route::get('/data-uraian-jadwal/delete/{id}', [JadwalController::class, 'destroyUraian'])->name('delete.data.uraian.jadwal');

    //layanan
    Route::get('/data-layanan', [LayananController::class, 'index'])->name('data.layanan');
    Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/update/{id}', [LayananController::class, 'update'])->name('update.layanan');
    Route::delete('/layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('destroy.layanan');

    //import
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('/data-keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::post('/data-keuangan', [KeuanganController::class, 'store'])->name('keuangan.store');
    Route::put('/keuangan/{id}', [KeuanganController::class, 'update'])->name('keuangan.update');
    Route::delete('/keuangan/{id}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
    Route::get('/data-verifikasi', [VerifikasiController::class, 'index'])->name('data.verifikasi');

    //Arsip
    Route::get('/data-arsip', [ArsipController::class, 'index']);
});
