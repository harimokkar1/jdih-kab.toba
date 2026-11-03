<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carousel;
use App\Models\StrukturOrganisasi;
use App\Models\Berita;
use App\Models\PeraturanDaerah;
use App\Models\PeraturanBupati;
use App\Models\KeputusanBupati;
use App\Models\Pengumuman;


class AdminController extends Controller
{
    // =========================================================
    // HALAMAN SUPER ADMIN
    // =========================================================

    public function superAdmin()
    {
        $admins = User::where('role', 'admin')->get();
        return view(
            'super-admin.dashboard',
            compact('admins')
        );
    }

    // =========================================================
    // TAMBAH ADMIN
    // =========================================================
    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'admin'
        ]);
        return redirect('/super-admin');
    }

    // =========================================================
    // HAPUS ADMIN
    // =========================================================
    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('/super-admin');
    }

    // =========================================================
    // DASHBOARD ADMIN
    // =========================================================

    public function dashboard()
    {
        // Total Carousel
        $totalCarousel = Carousel::count();
        // Total Struktur Organisasi
        $totalStruktur = StrukturOrganisasi::count();
        // Total Berita
        $totalBerita = Berita::count();
        // Total Peraturan Daerah
        $totalPeraturanDaerah = PeraturanDaerah::count();
        // Total Peraturan Bupati
        $totalPeraturanBupati = PeraturanBupati::count();
        // Total Keputusan Bupati
        $totalKeputusanBupati = KeputusanBupati::count();
        // TOTAL PENGUMUMAN
        $totalPengumuman = Pengumuman::count();

        return view('admin.dashboard', compact(
            'totalCarousel',
            'totalStruktur',
            'totalBerita',
            'totalPeraturanDaerah',
            'totalPeraturanBupati',
            'totalKeputusanBupati',
            'totalPengumuman'
        ));
    }
}