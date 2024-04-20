<?php
//

use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TransaksiController;
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

// <<<<<<< login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/data-users', [DataUserController::class, 'index'])->name('data.users');
    Route::get('/data-biodata', [BiodataController::class, 'index'])->name('data.biodata');
    Route::post('/store-biodata', [BiodataController::class, 'store'])->name('store.biodata');
    Route::get('/data-transaksi', [TransaksiController::class, 'index'])->name('data.transaksi');
    Route::get('/data-role', [RoleController::class, 'index'])->name('data.role');
    Route::post('/store/role', [RoleController::class, 'store'])->name('store.role');
    Route::post('/update/role/{id}', [RoleController::class, 'update'])->name('update.role');
    Route::delete('/destroy/role/{id}', [RoleController::class, 'destroy'])->name('destroy.role');
    Route::get('/data-jadwal', [JadwalController::class, 'index'])->name('data.jadwal');
    Route::get('/data-layanan', [LayananController::class, 'index'])->name('data.layanan');
    Route::post('/import', [ImportController::class, 'import'])->name('import');
    Route::get('/data-keuangan', [KeuanganController::class, 'index'])->name('data.keuangan');
});
