<?php
//

use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JadwalController;
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
Route::post('/otp-verification', [AuthController::class, 'otpVerificationPost']);

// <<<<<<< login
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // =======
    // Route::controller(DashboardController::class)->group(function () {
    //     Route::get('/dashboard', 'index');
    // });
    // Route::controller(App\Http\Controllers\Admin\DataUserController::class)->group(function () {
    //     Route::get('/data-users', 'index');
    //     Route::post('/user/create', 'add')->name('user.create');
    // });
    // Route::controller(App\Http\Controllers\Admin\BiodataController::class)->group(function () {
    //     Route::get('/data-biodata', 'index')->name('index.biodata');
    //     Route::post('/store-biodata', 'store')->name('store.biodata');
    // });
    // Route::controller(App\Http\Controllers\Admin\TransaksiController::class)->group(function () {
    //     Route::get('/data-transaksi', 'index');
    // });
    // Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
    //     Route::get('/data-role', 'index')->name('index.role');
    //     Route::post('/store/role', 'store')->name('store.role');
    //     Route::post('/update/role/{id}', 'update')->name('update.role');
    //     Route::delete('/destroy/role/{id}', 'destroy')->name('destroy.role');
    // });
    // Route::controller(App\Http\Controllers\Admin\JadwalController::class)->group(function () {
    //     Route::get('/data-jadwal', 'index');
    // });
    // Route::controller(App\Http\Controllers\Admin\LayananController::class)->group(function () {
    //     Route::get('/data-layanan', 'index');
    // });
    // >>>>>>> main

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
    //transaksi
    Route::get('/data-transaksi', [TransaksiController::class, 'index'])->name('data.transaksi');

    //role
    Route::get('/data-role', [RoleController::class, 'index'])->name('data.role');
    Route::post('/store/role', [RoleController::class, 'store'])->name('store.role');
    Route::post('/update/role/{id}', [RoleController::class, 'update'])->name('update.role');
    Route::delete('/destroy/role/{id}', [RoleController::class, 'destroy'])->name('destroy.role');

    //jadwal
    Route::get('/data-jadwal', [JadwalController::class, 'index'])->name('data.jadwal');

    //layanan
    Route::get('/data-layanan', [LayananController::class, 'index'])->name('data.layanan');
    Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
    Route::put('/layanan/update/{id}', [LayananController::class, 'update'])->name('update.layanan');
    Route::delete('/layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('destroy.layanan');
    //import
    Route::post('/import', [ImportController::class, 'import'])->name('import');
});
