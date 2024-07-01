<?php
//

use App\Http\Controllers\Admin\ArsipController;
use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Admin\DataUserController;
use App\Http\Controllers\Admin\HasilController;
use App\Http\Controllers\Admin\ImportController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TransaksiController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\WhatsappController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\finance\FinanceUserController;
use App\Http\Controllers\Finance\FKeuanganController;
use App\Http\Controllers\Finance\FTransaksiController;
use App\Http\Controllers\Finance\ReportFinanceController;
use App\Http\Controllers\FrontOffice\OfficeJadwalController;
use App\Http\Controllers\FrontOffice\OfficeLayananController;
use App\Http\Controllers\FrontOffice\OfficeReportController;
use App\Http\Controllers\FrontOffice\OfficeTransakController;
use App\Http\Controllers\FrontOffice\OfficeTransController;
use App\Http\Controllers\FrontOffice\OfficeVerifController;
use App\Http\Controllers\FrontOffice\OfficeVerifTransController;
use App\Http\Controllers\Jamaah\JadwalJamaahController;
use App\Http\Controllers\Jamaah\JamaahController;
use App\Http\Controllers\Jamaah\JamaahTransController;
use App\Http\Controllers\Jamaah\KeuanganJamaahController;
use App\Http\Controllers\Jamaah\LayananJamaahController;
use App\Http\Controllers\KBIH\KBArsipController;
use App\Http\Controllers\KBIH\KBBioController;
use App\Http\Controllers\KBIH\KBJadwalController;
use App\Http\Controllers\KBIH\KBKeuanganController;
use App\Http\Controllers\KBIH\KBLayananController;
use App\Http\Controllers\KBIH\KBReportController;
use App\Http\Controllers\KBIH\KBRoleController;
use App\Http\Controllers\KBIH\KBTransaksiController;
use App\Http\Controllers\KBIH\KBUserController;
use App\Http\Controllers\KBIH\KBVerifController;
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
Route::get('/forgot', [ForgotController::class, 'index']);

Route::middleware('auth')->group(function () {

    Route::get('/loading', function () {
        return view('pages.auth.loading');
    })->name('loading');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->group(function () {

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

        // Verif
        Route::post('/verif/{id}', [VerifikasiController::class, 'verif'])->name('verif');

        // JANGAN DIHAPUS, BUAT TESTING
        Route::get('/whatsapp', [WhatsappController::class, 'index']);
        Route::post('/whatsapp', [WhatsappController::class, 'testing'])->name('wa.testing');

        Route::controller(ReportController::class)->group(function () {
            Route::get('/data-report', 'index');
            Route::delete('/data-report/{id}', 'destroy')->name('delete.report');
            Route::get('/data-report/view/{id}', 'view')->name('detail.report');
        });

        //arsip
        Route::get('/data-arsip', [ArsipController::class, 'index'])->name('arsip.index');
        Route::get('/export/excel', [ArsipController::class, 'exportToExcel'])->name('export.excel');
        Route::get('/export/pdf', [ArsipController::class, 'exportToPDF'])->name('export.pdf');
        // Route::get('/export-pdf/{id_jamaah}', [ArsipController::class, 'exportToPDFId'])->name('export.id.jamaah');

        // SEND JADWAL WHATSAPP GRUP
        Route::post('/send-request/whatsapp/jadwal/{id}', [JadwalController::class, 'send_whatsapp'])->name('send.whatsapp.jadwal');
    });

    Route::middleware('role:jamaah')->group(function () {
        Route::controller(JamaahController::class)->group(function () {
            Route::get('/data-jamaah', 'index');
            Route::post('/data-jamaah/store', 'store')->name('jamaah.store');
        });

        Route::controller(LayananJamaahController::class)->group(function () {
            Route::get('/layanan-jamaah', 'index');
        });

        Route::controller(JamaahTransController::class)->group(function () {
            Route::get('/jamaah-transaksi', 'index');
            Route::post('/jamaah-transaksi-store', 'store')->name('Jamaah.transaksi');
        });

        Route::controller(KeuanganJamaahController::class)->group(function () {
            Route::get('/jamaah-keuangan', 'index');
        });

        Route::controller(JadwalJamaahController::class)->group(function () {
            Route::get('/jamaah-jadwal', 'index');
        });
    });
    Route::middleware('role:finance')->group(function () {
        Route::controller(FKeuanganController::class)->group(function () {
            Route::get('/f-keuangan', 'index');
            Route::post('/f-keuangan-store', 'store')->name('finance.store');
            Route::post('/f-keuangan-update/{id}', 'update')->name('finance.update');
            Route::delete('/f-keuangan-destroy', 'destroy');
        });

        Route::controller(FTransaksiController::class)->group(function () {
            Route::get('/f-transaksi', 'index');
        });

        Route::controller(ReportFinanceController::class)->group(function () {
            Route::get('/reportK', 'index');
            Route::get('/report-view', 'view');
        });
    });
    Route::middleware('role:front office')->group(function () {

        Route::controller(OfficeVerifController::class)->group(function () {
            Route::get('/Office-verif', 'index');
            Route::post('/verif/jamaah/{id}', 'verif')->name('verif.office');
        });

        Route::controller(OfficeVerifTransController::class)->group(function () {
            Route::get('/Office-transaksi', 'index');
            Route::post('/verif/transaksi/{id}', 'verifTransaksi')->name('verif.transaksi');
        });


        Route::controller(OfficeLayananController::class)->group(function () {
            Route::get('/office-layanan', 'index')->name('office.index');
            Route::post('/office-store', 'store')->name('Olayanan.store');
            Route::put('/office-update/{id}', 'update')->name('Olayanan.update');
            Route::delete('/office-destroy/{id}', 'destroy')->name('Odestroy');
        });

        Route::controller(OfficeTransakController::class)->group(function () {
            Route::get('/front-transaksi', 'index');
        });

        Route::controller(OfficeReportController::class)->group(function () {
            Route::get('/office-report', 'index');
            Route::get('/office-report-view', 'view');
        });

        // JADWAL
        Route::post('/import', [OfficeJadwalController::class, 'import'])->name('import');
        Route::get('/data-jadwal-office', [OfficeJadwalController::class, 'index'])->name('data.jadwal');
        Route::get('/data-jadwal-office/delete/{id}', [OfficeJadwalController::class, 'destroy'])->name('delete.data.jadwal.office');
        Route::get('/data-uraian-jadwal-office/delete/{id}', [OfficeJadwalController::class, 'destroyUraian'])->name('delete.data.uraian.jadwal.office');
        Route::post('/send-request/whatsapp/jadwal/{id}', [OfficeJadwalController::class, 'send_whatsapp'])->name('send.whatsapp.jadwal');
    });
    Route::middleware('role:kbih')->group(function () {

        Route::controller(KBUserController::class)->group(function () {
            Route::get('/kb-user', 'index');
        });

        Route::controller(KBRoleController::class)->group(function () {
            Route::get('/kb-role', 'index');
        });

        Route::controller(KBBioController::class)->group(function () {
            Route::get('/kb-biodata', 'index');
        });

        Route::controller(KBVerifController::class)->group(function () {
            Route::get('/kb-verif', 'index');
        });

        Route::controller(KBLayananController::class)->group(function () {
            Route::get('/kb-layanan', 'index');
        });

        Route::controller(KBTransaksiController::class)->group(function () {
            Route::get('/kb-transaksi', 'index');
        });

        Route::controller(KBJadwalController::class)->group(function () {
            Route::get('/kb-jadwal', 'index');
        });

        Route::controller(KBKeuanganController::class)->group(function () {
            Route::get('/kb-keuangan', 'index');
        });

        Route::controller(KBReportController::class)->group(function () {
            Route::get('/kb-report', 'index');
            Route::get('/kb-view', 'view');
        });

        Route::controller(KBArsipController::class)->group(function () {
            Route::get('/kb-arsip', 'index');
            Route::get('/export/pdf/kbih', 'exportToPDF')->name('export.pdf.kbih');
        });
    });
});
