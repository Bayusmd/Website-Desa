<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// =====================
//  HALAMAN UTAMA PUBLIK
// =====================
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AduanController;
use App\Http\Controllers\PermohonanSuratController;
use App\Http\Controllers\PerangkatDesaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PermohonanTrackingController;








// Halaman beranda publik
Route::get('/', [HomeController::class, 'index'])->name('home');


// =====================
//     INFORMASI DESA
// =====================
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi.index');
Route::get('/informasi/{id}', [InformasiController::class, 'show'])->name('informasi.show');

// =====================
//      AGENDA DESA
// =====================
Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
Route::get('/agenda/{id}', [AgendaController::class, 'show'])->name('agenda.show');

// =====================
//     ADUAN MASYARAKAT
// =====================
Route::get('/aduan', [AduanController::class, 'create'])->name('aduan.create');
Route::post('/aduan', [AduanController::class, 'store'])->name('aduan.store');

// =====================
//   PERMOHONAN SURAT
// =====================
Route::get('/permohonan-surat', [PermohonanSuratController::class, 'index'])->name('permohonan.index');
Route::get('/permohonan-surat/{id}/ajukan', [PermohonanSuratController::class, 'create'])->name('permohonan.create');
Route::post('/permohonan-surat', [PermohonanSuratController::class, 'store'])->name('permohonan.store');

// =====================
//   TRACKING PERMOHONAN SURAT
// =====================

Route::get('/permohonan/riwayat', [PermohonanTrackingController::class, 'index'])->name('permohonan.riwayat');
Route::post('/permohonan/riwayat', [PermohonanTrackingController::class, 'search'])->name('permohonan.riwayat.search');

// =====================
//   Perangkat Desa
// =====================
Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index'])
    ->name('perangkat.index');


// =====================
//   Jumlah Penduduk Desa
// =====================
Route::get('/api/penduduk', [PendudukController::class, 'index']);

// =====================
//   Berita Desa
// =====================
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');


// =====================
//    ROUTE BREEZE (AUTH)
// =====================

// Route::get('/', function () {
    // return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';













