<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\StrukturController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PeraturanDaerahController;
use App\Http\Controllers\PeraturanBupatiController;
use App\Http\Controllers\KeputusanBupatiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengumumanController;

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/

// Redirect ke home
Route::get('/', function () {
    return redirect('/home');
});


// Home
Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

// Visi & Misi
Route::get('/visi', [VisiMisiController::class, 'show'])
    ->name('visi');


// Sejarah
Route::get('/sejarah', [CarouselController::class, 'sejarah'])
    ->name('sejarah');


// Kontak
Route::get('/kontak', [CarouselController::class, 'kontak'])
    ->name('kontak');


// Struktur Organisasi User
Route::get('/organisasi', [StrukturController::class, 'index'])
    ->name('struktur');


// Berita User
Route::get('/berita', [BeritaController::class, 'userIndex'])
    ->name('berita');


// Detail Berita User
Route::get('/berita/{id}', [BeritaController::class, 'show'])
    ->name('berita.detail');


/*
|--------------------------------------------------------------------------
| USER PERATURAN DAERAH
|--------------------------------------------------------------------------
*/

Route::get(
    '/peraturan-daerah',
    [PeraturanDaerahController::class, 'userIndex']
)->name('user.peraturan-daerah');

Route::get(
    '/peraturan-daerah/{id}',
    [PeraturanDaerahController::class, 'show']
)->name('user.peraturan-daerah.detail');


/*
|--------------------------------------------------------------------------
| USER PERATURAN BUPATI
|--------------------------------------------------------------------------
*/

Route::get(
    '/peraturan-bupati',
    [PeraturanBupatiController::class, 'userIndex']
)->name('user.peraturan-bupati');

Route::get(
    '/peraturan-bupati/{id}',
    [PeraturanBupatiController::class, 'userDetail']
)->name('user.peraturan-bupati.detail');


/*
|--------------------------------------------------------------------------
| KEPUTUSAN BUPATI - USER
|--------------------------------------------------------------------------
*/

Route::get(
    '/keputusan-bupati',
    [KeputusanBupatiController::class, 'userIndex']
)->name('user.keputusan-bupati');

Route::get(
    '/keputusan-bupati/{keputusanBupati}',
    [KeputusanBupatiController::class, 'show']
)->name('user.keputusan-bupati.detail');

// ========================================
// PENGUMUMAN - USER
// ========================================

Route::get('/pengumuman', [PengumumanController::class, 'userIndex'])
    ->name('pengumuman.index');

Route::get('/pengumuman/{id}', [PengumumanController::class, 'show'])
    ->name('pengumuman.show');


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login']);


// Logout
Route::post('/logout', [AuthController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/admin',
        [AdminController::class, 'dashboard']
    )->name('admin.dashboard');


    /*
    |--------------------------------------------------------------------------
    | SUPER ADMIN
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/super-admin',
        [AdminController::class, 'superAdmin']
    )->name('super-admin');

    Route::post(
        '/admin/store',
        [AdminController::class, 'store']
    )->name('admin.store');

    Route::post(
        '/admin/delete/{id}',
        [AdminController::class, 'delete']
    )->name('admin.delete');


    /*
    |--------------------------------------------------------------------------
    | CAROUSEL
    |--------------------------------------------------------------------------
    */

    // Halaman admin carousel
    Route::get(
        '/admin/carousel',
        [CarouselController::class, 'index']
    )->name('admin.carousel');

    // Simpan carousel
    Route::post(
        '/carousel/store',
        [CarouselController::class, 'store']
    )->name('carousel.store');

    // Hapus carousel
    Route::post(
        '/carousel/delete/{id}',
        [CarouselController::class, 'delete']
    )->name('carousel.delete');

    // Update carousel
    Route::put(
        '/carousel/update/{id}',
        [CarouselController::class, 'update']
    )->name('carousel.update');


    /*
    |--------------------------------------------------------------------------
    | VISI & MISI
    |--------------------------------------------------------------------------
    */

    // Halaman admin visi misi
    Route::get(
        '/admin/visi',
        [VisiMisiController::class, 'index']
    )->name('admin.visi');

    // Simpan / update visi misi
    Route::post(
        '/admin/visi',
        [VisiMisiController::class, 'save']
    )->name('admin.visi.save');


    /*
    |--------------------------------------------------------------------------
    | STRUKTUR ORGANISASI
    |--------------------------------------------------------------------------
    */

    // Halaman admin struktur
    Route::get(
        '/admin/struktur',
        [StrukturController::class, 'admin']
    )->name('admin.struktur');

    // Create
    Route::get(
        '/admin/struktur/create',
        [StrukturController::class, 'create']
    )->name('admin.struktur.create');

    // Store
    Route::post(
        '/admin/struktur',
        [StrukturController::class, 'store']
    )->name('admin.struktur.store');

    // Edit
    Route::get(
        '/admin/struktur/{id}/edit',
        [StrukturController::class, 'edit']
    )->name('admin.struktur.edit');

    // Update
    Route::put(
        '/admin/struktur/{id}',
        [StrukturController::class, 'update']
    )->name('admin.struktur.update');

    // Delete
    Route::delete(
        '/admin/struktur/{id}',
        [StrukturController::class, 'destroy']
    )->name('admin.struktur.destroy');


    /*
    |--------------------------------------------------------------------------
    | BERITA
    |--------------------------------------------------------------------------
    */

    // Halaman admin berita
    Route::get(
        '/admin/berita',
        [BeritaController::class, 'index']
    )->name('admin.berita');

    // Simpan berita
    Route::post(
        '/admin/berita',
        [BeritaController::class, 'store']
    )->name('admin.berita.store');

    // Update berita
    Route::put(
        '/admin/berita/{id}',
        [BeritaController::class, 'update']
    )->name('admin.berita.update');

    // Hapus berita
    Route::delete(
        '/admin/berita/{id}',
        [BeritaController::class, 'destroy']
    )->name('admin.berita.destroy');


    /*
    |--------------------------------------------------------------------------
    | ADMIN PERATURAN DAERAH
    |--------------------------------------------------------------------------
    */

    // Halaman admin Peraturan Daerah
    Route::get(
        '/admin/peraturan-daerah',
        [PeraturanDaerahController::class, 'index']
    )->name('admin.peraturan-daerah');

    // Simpan Peraturan Daerah
    Route::post(
        '/admin/peraturan-daerah',
        [PeraturanDaerahController::class, 'store']
    )->name('admin.peraturan-daerah.store');

    // Update Peraturan Daerah
    Route::put(
        '/admin/peraturan-daerah/{id}',
        [PeraturanDaerahController::class, 'update']
    )->name('admin.peraturan-daerah.update');

    // Hapus Peraturan Daerah
    Route::delete(
        '/admin/peraturan-daerah/{id}',
        [PeraturanDaerahController::class, 'destroy']
    )->name('admin.peraturan-daerah.destroy');


    /*
|--------------------------------------------------------------------------
| ADMIN PERATURAN BUPATI
|--------------------------------------------------------------------------
*/

    // Halaman admin Peraturan Bupati
    Route::get(
        '/admin/peraturan-bupati',
        [PeraturanBupatiController::class, 'index']
    )->name('admin.peraturan-bupati.index');

    // Simpan Peraturan Bupati
    Route::post(
        '/admin/peraturan-bupati',
        [PeraturanBupatiController::class, 'store']
    )->name('admin.peraturan-bupati.store');

    // Update Peraturan Bupati
    Route::put(
        '/admin/peraturan-bupati/{id}',
        [PeraturanBupatiController::class, 'update']
    )->name('admin.peraturan-bupati.update');

    // Hapus Peraturan Bupati
    Route::delete(
        '/admin/peraturan-bupati/{id}',
        [PeraturanBupatiController::class, 'destroy']
    )->name('admin.peraturan-bupati.destroy');


    /*
|--------------------------------------------------------------------------
| ADMIN KEPUTUSAN BUPATI
|--------------------------------------------------------------------------
*/

    // Halaman admin Keputusan Bupati
    Route::get(
        '/admin/keputusan-bupati',
        [KeputusanBupatiController::class, 'index']
    )->name('admin.keputusan-bupati');

    // Simpan Keputusan Bupati
    Route::post(
        '/admin/keputusan-bupati',
        [KeputusanBupatiController::class, 'store']
    )->name('admin.keputusan-bupati.store');

    // Update Keputusan Bupati
    Route::put(
        '/admin/keputusan-bupati/{id}',
        [KeputusanBupatiController::class, 'update']
    )->name('admin.keputusan-bupati.update');

    // Hapus Keputusan Bupati
    Route::delete(
        '/admin/keputusan-bupati/{id}',
        [KeputusanBupatiController::class, 'destroy']
    )->name('admin.keputusan-bupati.destroy');

    // ========================================
    // PENGUMUMAN - ADMIN
    // ========================================

    Route::get('/admin/pengumuman', [PengumumanController::class, 'index'])
        ->name('admin.pengumuman.index');

    Route::post('/admin/pengumuman', [PengumumanController::class, 'store'])
        ->name('admin.pengumuman.store');

    Route::put('/admin/pengumuman/{id}', [PengumumanController::class, 'update'])
        ->name('admin.pengumuman.update');

    Route::delete('/admin/pengumuman/{id}', [PengumumanController::class, 'destroy'])
        ->name('admin.pengumuman.destroy');
});
