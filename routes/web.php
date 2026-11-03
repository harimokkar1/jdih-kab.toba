<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenisPeraturanController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ProdukHukumController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\VisiMisiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| USER / PUBLIC AREA
|--------------------------------------------------------------------------
*/

// Redirect root ke /home
Route::get('/', function () {
    return redirect()->route('home');
});

// Beranda Utama
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Pencarian Dokumen Multi-Parameter (Requirement #1)
Route::get('/cari', [SearchController::class, 'search'])->name('user.cari');

// Produk Hukum Global (Requirement #4)
Route::get('/produk-hukum', [ProdukHukumController::class, 'globalIndex'])->name('user.produk-hukum.global');
Route::get('/produk-hukum/{id}', [ProdukHukumController::class, 'detail'])->name('user.produk-hukum.detail');
Route::get('/produk-hukum/{id}/download/{type?}', [ProdukHukumController::class, 'download'])->name('user.produk-hukum.download');

// Produk Hukum per Kategori/Jenis (Requirement #4)
Route::get('/kategori/{slug}', [ProdukHukumController::class, 'listByJenis'])->name('user.produk-hukum.jenis');

// Backward Compatibility untuk URL lama (Perda, Perbup, Kepbup)
Route::get('/peraturan-daerah', function () {
    return redirect()->route('user.produk-hukum.jenis', 'peraturan-daerah');
})->name('user.peraturan-daerah');

Route::get('/peraturan-daerah/{id}', function ($id) {
    return redirect()->route('user.produk-hukum.detail', $id);
})->name('user.peraturan-daerah.detail');

Route::get('/peraturan-bupati', function () {
    return redirect()->route('user.produk-hukum.jenis', 'peraturan-bupati');
})->name('user.peraturan-bupati');

Route::get('/peraturan-bupati/{id}', function ($id) {
    return redirect()->route('user.produk-hukum.detail', $id);
})->name('user.peraturan-bupati.detail');

Route::get('/keputusan-bupati', function () {
    return redirect()->route('user.produk-hukum.jenis', 'keputusan-bupati');
})->name('user.keputusan-bupati');

Route::get('/keputusan-bupati/{id}', function ($id) {
    return redirect()->route('user.produk-hukum.detail', $id);
})->name('user.keputusan-bupati.detail');

// Profil
Route::get('/sejarah', [CarouselController::class, 'sejarah'])->name('sejarah');
Route::get('/visi', [VisiMisiController::class, 'show'])->name('visi');
Route::get('/organisasi', [StrukturController::class, 'index'])->name('struktur');
Route::get('/kontak', [CarouselController::class, 'kontak'])->name('kontak');

// Informasi
Route::get('/berita', [BeritaController::class, 'userIndex'])->name('berita');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.detail');
Route::get('/pengumuman', [PengumumanController::class, 'userIndex'])->name('pengumuman.index');
Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])->name('pengumuman.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL AREA (auth middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dasbor
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Submenu 1: Kelola Jenis Peraturan (Requirement #3)
    Route::get('/jenis-peraturan', [JenisPeraturanController::class, 'index'])->name('admin.jenis-peraturan.index');
    Route::post('/jenis-peraturan', [JenisPeraturanController::class, 'store'])->name('admin.jenis-peraturan.store');
    Route::put('/jenis-peraturan/{id}', [JenisPeraturanController::class, 'update'])->name('admin.jenis-peraturan.update');
    Route::delete('/jenis-peraturan/{id}', [JenisPeraturanController::class, 'destroy'])->name('admin.jenis-peraturan.destroy');

    // Submenu 2: Kelola Isi Dokumen Peraturan (Requirement #3)
    Route::get('/peraturan', [ProdukHukumController::class, 'adminIndex'])->name('admin.peraturan.index');
    Route::get('/peraturan/create', [ProdukHukumController::class, 'create'])->name('admin.peraturan.create');
    Route::post('/peraturan', [ProdukHukumController::class, 'store'])->name('admin.peraturan.store');
    Route::get('/peraturan/{id}/edit', [ProdukHukumController::class, 'edit'])->name('admin.peraturan.edit');
    Route::put('/peraturan/{id}', [ProdukHukumController::class, 'update'])->name('admin.peraturan.update');
    Route::delete('/peraturan/{id}', [ProdukHukumController::class, 'destroy'])->name('admin.peraturan.destroy');

    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita');
    Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.destroy');

    // Pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('admin.pengumuman.index');
    Route::post('/pengumuman', [PengumumanController::class, 'store'])->name('admin.pengumuman.store');
    Route::put('/pengumuman/{id}', [PengumumanController::class, 'update'])->name('admin.pengumuman.update');
    Route::delete('/pengumuman/{id}', [PengumumanController::class, 'destroy'])->name('admin.pengumuman.destroy');

    // Carousel
    Route::get('/carousel', [CarouselController::class, 'index'])->name('admin.carousel');
    Route::post('/carousel', [CarouselController::class, 'store'])->name('admin.carousel.store');
    Route::put('/carousel/{id}', [CarouselController::class, 'update'])->name('admin.carousel.update');
    Route::delete('/carousel/{id}', [CarouselController::class, 'delete'])->name('admin.carousel.destroy');

    // Struktur Organisasi
    Route::get('/struktur', [StrukturController::class, 'admin'])->name('admin.struktur');
    Route::post('/struktur', [StrukturController::class, 'store'])->name('admin.struktur.store');
    Route::put('/struktur/{id}', [StrukturController::class, 'update'])->name('admin.struktur.update');
    Route::delete('/struktur/{id}', [StrukturController::class, 'destroy'])->name('admin.struktur.destroy');

    // Visi & Misi
    Route::get('/visi', [VisiMisiController::class, 'index'])->name('admin.visi');
    Route::post('/visi', [VisiMisiController::class, 'save'])->name('admin.visi.save');
});

// Alias rute lama carousel agar kompatibel
Route::middleware(['auth'])->group(function () {
    Route::post('/carousel/store', [CarouselController::class, 'store'])->name('carousel.store');
    Route::put('/carousel/update/{id}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::post('/carousel/delete/{id}', [CarouselController::class, 'delete'])->name('carousel.delete');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN AREA (Dilindungi middleware super_admin)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'super_admin'])->group(function () {
    Route::get('/super-admin', [AdminController::class, 'superAdmin'])->name('super-admin');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::post('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
});
