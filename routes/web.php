<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing');
});

Route::controller(App\Http\Controllers\Auth\AuthController::class)->group(function () {
    Route::get('/login', 'index');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'index');
});
Route::controller(App\Http\Controllers\Admin\DataUserController::class)->group(function () {
    Route::get('/data-users', 'index');
});
Route::controller(App\Http\Controllers\Admin\BiodataController::class)->group(function () {
    Route::get('/data-biodata', 'index')->name('index.biodata');
    Route::post('/store-biodata', 'store')->name('store.biodata');
});
Route::controller(App\Http\Controllers\Admin\TransaksiController::class)->group(function () {
    Route::get('/data-transaksi', 'index');
});
Route::controller(App\Http\Controllers\Admin\RoleController::class)->group(function () {
    Route::get('/data-role', 'index')->name('index.role');
    Route::post('/store/role', 'store')->name('store.role');
    Route::post('/update/role/{id}', 'update')->name('update.role');
    Route::delete('/destroy/role/{id}', 'destroy')->name('destroy.role');
});
Route::controller(App\Http\Controllers\Admin\JadwalController::class)->group(function () {
    Route::get('/data-jadwal', 'index');
});
Route::controller(App\Http\Controllers\Admin\LayananController::class)->group(function () {
    Route::get('/data-layanan', 'index');
});
