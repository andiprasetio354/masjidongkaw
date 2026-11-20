<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardKontenController;
use App\Http\Controllers\DashboardKeuanganController;

/*
|--------------------------------------------------------------------------
| Public Routes (Jamaah & Masyarakat Umum)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/jadwal-salat', [HomeController::class, 'jadwalSalat'])->name('jadwal-salat');
Route::get('/sedekah', [HomeController::class, 'sedekah'])->name('sedekah');
Route::post('/sedekah', [HomeController::class, 'submitDonasi'])->name('sedekah.submit');
Route::get('/layanan-program', [HomeController::class, 'layananProgram'])->name('layanan-program');
Route::get('/pengurus', [HomeController::class, 'pengurus'])->name('pengurus');
Route::get('/profil', [HomeController::class, 'pengurus'])->name('profil');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [HomeController::class, 'submitPesan'])->name('kontak.submit');

/*
|--------------------------------------------------------------------------
| Authentication Routes (Portal Login Pengurus)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.get');

/*
|--------------------------------------------------------------------------
| Dashboard Admin 1: Konten & Syiar Dakwah (Humas & Sekretariat)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/konten')->name('admin.konten.')->middleware(['auth', 'role:konten'])->group(function () {
    Route::get('/', [DashboardKontenController::class, 'index'])->name('index');
    Route::get('/jadwal-salat', [DashboardKontenController::class, 'jadwalSalat'])->name('jadwal');
    Route::post('/jadwal-salat/sync', [DashboardKontenController::class, 'syncKemenag'])->name('jadwal.sync');
    Route::post('/jadwal-salat/sync-kemenag', [DashboardKontenController::class, 'syncKemenag'])->name('jadwal.sync-kemenag');
    Route::post('/petugas-jumat', [DashboardKontenController::class, 'storeFridayOfficer'])->name('officer.store');
    Route::post('/petugas-jumat/store', [DashboardKontenController::class, 'storeFridayOfficer'])->name('jadwal.store-officer');
    Route::post('/petugas-jumat/badal', [DashboardKontenController::class, 'assignBadal'])->name('officer.badal');
    Route::post('/petugas-jumat/assign-badal', [DashboardKontenController::class, 'assignBadal'])->name('jadwal.assign-badal');
    Route::post('/tv-display', [DashboardKontenController::class, 'updateTvSettings'])->name('tv.update');
    Route::post('/tv-display/update', [DashboardKontenController::class, 'updateTvSettings'])->name('jadwal.update-tv');
    
    Route::get('/agendas', [DashboardKontenController::class, 'agendas'])->name('agendas');
    Route::post('/agendas', [DashboardKontenController::class, 'storeAgenda'])->name('agendas.store');
    Route::delete('/agendas/{agenda}', [DashboardKontenController::class, 'deleteAgenda'])->name('agendas.delete');

    Route::get('/berita', [DashboardKontenController::class, 'berita'])->name('berita');
    Route::post('/berita', [DashboardKontenController::class, 'storeBerita'])->name('berita.store');
    Route::delete('/berita/{berita}', [DashboardKontenController::class, 'deleteBerita'])->name('berita.delete');

    Route::get('/galeri', [DashboardKontenController::class, 'galeri'])->name('galeri');
    Route::post('/galeri', [DashboardKontenController::class, 'storeGaleri'])->name('galeri.store');
    Route::delete('/galeri/{photo}', [DashboardKontenController::class, 'deleteGaleri'])->name('galeri.delete');

    Route::get('/pengurus', [DashboardKontenController::class, 'pengurus'])->name('pengurus');
    Route::post('/pengurus', [DashboardKontenController::class, 'storePengurus'])->name('pengurus.store');
    Route::delete('/pengurus/{member}', [DashboardKontenController::class, 'deletePengurus'])->name('pengurus.delete');

    Route::get('/pesan', [DashboardKontenController::class, 'pesan'])->name('pesan');
    Route::post('/pesan/{message}/read', [DashboardKontenController::class, 'markMessageRead'])->name('pesan.read');
    Route::post('/pesan/{message}/toggle-read', [DashboardKontenController::class, 'markMessageRead'])->name('pesan.toggle-read');

    Route::get('/pengaturan', [DashboardKontenController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/pengaturan', [DashboardKontenController::class, 'updatePengaturan'])->name('pengaturan.update');
    Route::post('/pengaturan/profile', [DashboardKontenController::class, 'updatePengaturan'])->name('pengaturan.profile');
    Route::post('/pengaturan/toggles', [DashboardKontenController::class, 'updatePengaturan'])->name('pengaturan.toggles');
});

/*
|--------------------------------------------------------------------------
| Dashboard Admin 2: Keuangan & Kas (Bendahara Umum BKM)
|--------------------------------------------------------------------------
*/
Route::prefix('admin/keuangan')->name('admin.keuangan.')->middleware(['auth', 'role:keuangan'])->group(function () {
    Route::get('/', [DashboardKeuanganController::class, 'index'])->name('index');
    Route::get('/verifikasi', [DashboardKeuanganController::class, 'verifikasi'])->name('verifikasi');
    Route::post('/verifikasi/{donation}', [DashboardKeuanganController::class, 'actionVerifikasi'])->name('verifikasi.action');

    Route::get('/buku-kas', [DashboardKeuanganController::class, 'bukuKas'])->name('buku-kas');
    Route::post('/buku-kas', [DashboardKeuanganController::class, 'storeCashMutation'])->name('buku-kas.store');
    Route::post('/kas/store', [DashboardKeuanganController::class, 'storeCashMutation'])->name('kas.store');

    Route::get('/programs', [DashboardKeuanganController::class, 'programSedekah'])->name('programs');
    Route::post('/programs', [DashboardKeuanganController::class, 'storeProgram'])->name('programs.store');

    Route::get('/rekening', [DashboardKeuanganController::class, 'rekeningQris'])->name('rekening');
    Route::post('/rekening', [DashboardKeuanganController::class, 'updateRekening'])->name('rekening.update');

    Route::get('/telegram', [DashboardKeuanganController::class, 'telegram'])->name('telegram');
    Route::post('/telegram', [DashboardKeuanganController::class, 'updateTelegram'])->name('telegram.update');
    Route::post('/telegram/ping', [DashboardKeuanganController::class, 'testTelegramPing'])->name('telegram.ping');

    Route::get('/laporan', [DashboardKeuanganController::class, 'laporanKas'])->name('laporan');
    Route::get('/audit-log', [DashboardKeuanganController::class, 'auditLog'])->name('audit-log');
});
